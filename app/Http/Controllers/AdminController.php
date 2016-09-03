<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\Score;
use App\Choice;
use App\Comment;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Initialize pagination
     *
     * @var int
     */
    private $pagination = 10;

    /**
     * Display the Dashboard for Auth users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Accueil / Dashboard';

        if (Auth::user()->role == 'teacher')
        {
            $questions = Question::latest('id')
                ->limit(3)
                ->get();

            $posts = Post::latest('date')
                ->limit(3)
                ->get();

            $comments = Comment::count();

            $fiches = Question::publish()
                ->count();

            $users = User::where('role','!=','teacher')
                ->count();

            return view('front.admin.profs.index', compact('title', 'questions', 'posts', 'comments', 'fiches', 'users'));
        }
        else
        {
            $fiches = Question::with('choices')
                ->publish()
                ->class(Auth::user()->role)
                ->get();

            $scores = Score::with('question')
                ->where('user_id','=',Auth::user()->id)
                ->where('status_question','=','fait')
                ->get();

            $note = 0;

            $qcm_fait = 0;

            foreach ($scores as $score)
            {
                if($score->question->status == 'publish')
                {
                    $qcm_fait++;

                    $note += $score->note;
                }
            }

            $total_score = array_sum($this->totalNote($fiches));

            $total_qcm = count($fiches);

            return view('front.admin.eleves.index', compact('title', 'qcm_fait', 'total_qcm', 'total_score', 'note'));
        }
    }

    /**
     * Display the QCM list for the students
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showListQCM()
    {
        $title = 'Liste des QCM';

        if(Auth::user()->role != 'teacher')
        {
            $fiches = Question::with('choices','scores')
                ->publish()
                ->class(Auth::user()->role)
                ->latest('updated_at')
                ->paginate($this->pagination);

            $total_note = $this->totalNote($fiches);

            return view('front.admin.eleves.questions.index', compact('title', 'fiches', 'total_note'));
        }
        else
            return redirect('admin');
    }

    /**
     * Display the specified QCM for the students
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showQCM($id)
    {
        $title = 'QCM';


        $score = Score::where('question_id','=',$id)
            ->where('user_id','=',Auth::user()->id)
            ->first();

        if(Auth::user()->role != 'teacher' && !is_null($score))
        {
            $fiche = Question::with('choices')
                ->findOrFail($id);

            $answers = DB::table('choice_user')
                ->select('*')
                ->where('user_id','=',Auth::user()->id)
                ->get();

            return view('front.admin.eleves.qcm.index', compact('title', 'fiche', 'score', 'answers'));
        }
        else
            return redirect('admin');
    }

    /**
     * Update the student's score after completing a QCM
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateScore(Request $request, $id)
    {
        $choices = Choice::where('question_id','=',$id)
            ->get();

        $note = 0;

        foreach($choices as $choice)
        {
            $this->validate($request,[
                'status'.$choice->id => 'in:ok'
            ]);

            $choice->users()
                ->attach(
                    Auth::user()->id,
                    ['choice_user' => $request->input('status'.$choice->id)]
                );

            if(!empty($request->input('status'.$choice->id)) && $choice->status == 'yes')
                $note += 2;
        }

        $score = Score::where('question_id','=',$id)
            ->where('user_id','=',$request->input('user_id'))
            ->first();

        $score->update([
            'status_question' => 'fait',
            'note' => $note
        ]);

        return redirect('admin/qcm/'.$id)->with('message', 'Votre QCM est bien validé !');
    }

    /**
     * Display the list of the students
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showStudent()
    {
        $title = 'Accueil / Elèves';

        $users = User::where('role','!=','teacher')
            ->paginate(20);

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.students.index', compact('title', 'users'));
        else
            return redirect('admin');
    }

    /**
     * Calculate student's score
     *
     * @param $fiches
     * @return array
     */
    public function totalNote($fiches)
    {
        $note = [];

        foreach($fiches as $fiche)
        {
            $note[$fiche->id] = 0;

            foreach($fiche->choices as $choice)
            {
                if($choice->status == 'yes')
                    $note[$fiche->id] += 2;
            }
        }

        return $note;
    }
}
