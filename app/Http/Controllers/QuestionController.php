<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Score;
use App\Choice;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        $fiches = Question::with('choices')
            ->latest('id')
            ->get();

        $title = 'Fiches';

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.fiches.index', compact('title', 'fiches', 'username'));
        else
            return redirect('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Fiches / Création';

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.fiches.question.create', compact('title'));
        else
            return redirect('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->except(['nb_choices']));

        for($i=0; $i<$request->input('nb_choices'); $i++)
        {
            Choice::create([
                'question_id' => $question->id,
                'content' => '',
                'status' => ''
            ]);
        }

        $choices = Choice::where('question_id','=',$question->id)
            ->get();

        $this->createScore($question);

        $datas = [
            'question_id' => $question->id,
            'choices' => $choices
        ];

        $request->session()->put('datas',$datas);

        return redirect('admin/fiches/choices/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        $title = 'Fiches / Edition';

        $fiche = Question::with('choices','scores')->findOrFail($id);

        $fait = false;

        foreach($fiche->scores as $score)
        {
            if($score->status_question == 'fait')
                $fait = true;
        }

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.fiches.question.edit', compact('title', 'fiche', 'fait'));
        else
            return redirect('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::with('scores')
            ->findOrFail($id);

        $question->update($request->except(['nb_choices']));

        $scores = Score::where('question_id','=',$id)
            ->where('status_question','=','pas_fait')
            ->get();

        foreach ($scores as $score)
            $score->delete();

        $this->createScore($question);

        return redirect('admin/fiches/choices/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ids)
    {
        $ids = explode(',',$ids);

        foreach($ids as $id)
        {
            $question = Question::findOrFail($id);

            $question->delete();
        }

        return redirect('admin/fiches')->with('message','Fiche(s) supprimée(s) !');
    }

    /**
     * Create score of question for each specified student
     *
     * @param Question $question
     * @return bool
     */
    public function createScore(Question $question)
    {
        if($question->class_level == 'terminale')
            $role = 'final_class';
        else
            $role = 'first_class';

        $users = User::where('role','=',$role)
            ->get();

        foreach ($users as $user)
        {
            Score::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'status_question' => 'pas_fait',
                'note' => 0
            ]);
        }
        return true;
    }

    /**
     * Update the status of the specified resources in storage
     *
     * @param Request $request
     * @param $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $ids)
    {
        $ids = explode(',',$ids);

        $choices = Choice::whereIn('question_id',$ids)
            ->get();

        foreach($choices as $choice)
        {
            if($choice->content == '')
                return redirect('admin/fiches')->with('alert', 'Vous ne pouvez pas publier un QCM dont les réponses sont vides !');
        }

        Question::whereIn('id',$ids)
            ->update(['status'=>$request->input('status')]);

        return redirect('admin/fiches')->with('message', 'Article(s) bien mis à jour !!');
    }
}
