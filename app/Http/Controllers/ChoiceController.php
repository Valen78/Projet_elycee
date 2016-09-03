<?php

namespace App\Http\Controllers;

use Auth;
use App\Choice;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            return view('front.admin.profs.fiches.choices.create', compact('title'));
        else
            return redirect('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $choices = Choice::where('question_id','=',$request->input('question_id'))
            ->get();

        $this->updateChoice($choices, $request);

        return redirect('admin/fiches')->with('message','Fiche ajoutée !');
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

        $fiche = Question::with('choices')->findOrFail($id);

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.fiches.choices.edit', compact('title', 'fiche'));
        else
            return redirect('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $question = Question::with('choices')->findOrFail($id);

        $title = $question->title;

        $this->updateChoice($question->choices, $request);

        return redirect('admin/fiches')->with(['message' => sprintf('Fiche %s bien mise à jour !!', $title)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update the specified resources in storage.
     *
     * @param $choices
     * @param Request $request
     * @return bool
     */
    public function updateChoice($choices, Request $request)
    {
        foreach($choices as $choice)
        {
            $this->validate($request, [
                'content'.$choice->id => 'required|string',
                'status'.$choice->id => 'required'
            ]);

            $choice->update([
                'content' => $request->input('content'.$choice->id),
                'status' => $request->input('status'.$choice->id)
            ]);
        }

        return true;
    }
}
