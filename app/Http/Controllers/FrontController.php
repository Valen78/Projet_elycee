<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    /**
     * Initialize pagination
     *
     * @var int
     */
    private $paginate = 5;

    /**
     * Display the Home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Accueil';

        $posts = Post::with('user')
            ->publish()
            ->latest('date')
            ->limit(4)
            ->get();

        $others = $this->randPost();

        return view('front.index', compact('posts', 'others', 'title'));
    }

    /**
     * Display all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $title = 'Actualités';

        $posts = Post::with('user')
            ->publish()
            ->latest('date')
            ->paginate($this->paginate);

        $others = $this->randPost();

        return view('front.showAll', compact('posts', 'others', 'title'));
    }

    /**
     * Display a specified posts
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPost($id)
    {
        $title = 'Article';

        $post = Post::findOrFail($id);

        $comments = Comment::select('*')
            ->where('post_id','=',$id)
            ->where('status','=','non_spam')
            ->latest('date')
            ->get();

        $date = Carbon::now('Europe/Paris');

        $others = $this->randPost();

        return view('front.showPost', compact('post', 'comments', 'date', 'others', 'title'));
    }

    /**
     * Store a newly comment in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'integer',
            'date' => 'date',
            'title' => 'required|string',
            'content' => 'required|string',
            'my_name' => 'honeypot',
            'my_time' => 'required|honeytime:5'
        ]);

        $postId = $request->input('post_id');

        \Akismet::setCommentContent($request->input('content'));

        if( \Akismet::isSpam())
            $status = 'spam';
        else
            $status = 'non_spam';

        Comment::create([
            'post_id' => $request->input('post_id'),
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $status
        ]);

        return redirect('article/' . $postId)->with('message', 'Merci pour votre commentaire.');
    }

    /**
     * Display Lycee page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLycee()
    {
        $title = 'Le Lycée';

        $others = $this->randPost();

        return view('front.lycee', compact('title', 'others'));
    }

    /**
     * Display Mentions legales page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMentions()
    {
        $title = 'Mentions légales';

        $others = $this->randPost();

        return view('front.mentions', compact('title', 'others'));
    }

    /**
     * Display contact form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showContact()
    {
        $title = 'Contactez-nous';

        $others = $this->randPost();

        $param = array('address' => '3 Rue Albert Seibel, 07200 Aubenas');
        $response = \Geocoder::geocode('json', $param);
        $location = json_decode($response);

        if($location->status == 'OK')
        {
            $address = $location->results[0]->formatted_address;
            $lat = $location->results[0]->geometry->location->lat;
            $lng = $location->results[0]->geometry->location->lng;
        }

        return view('front.contact', compact('title', 'others', 'address', 'lat', 'lng'));
    }

    /**
     * Send email form contact form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'required|string',
            'content' => 'required|string'
        ]);

        Mail::send('emails.contact', $request->all(), function($message) use ($request){
            $message->from('no-reply@rangoon.fr','no-reply')
                ->replyto($request->input('email'))
                ->to($request->input('email'))
                ->subject($request->input('subject'));
        });

        return redirect('contact')->with('message', 'Merci, nous traiterons votre demande dans les plus brefs délais.');
    }

    /**
     * Select 3 random posts
     *
     * @return array
     */
    public function randPost()
    {
        $posts = Post::publish()->get();

        $items = [];
        $otherPosts = [];

        for($i=0 ; $i<3; $i++)
        {
            if (count($posts)>5)
            {
                do
                $value = rand(0, count($posts) - 1);
                while (in_array($value, $items));

                array_push($items, $value);
            }
            else
                array_push($items, rand(0, count($posts) - 1));
        }

        foreach($items as $item)
            array_push($otherPosts,$posts[$item]);

        return $otherPosts;
    }

    /**
     * Select information in storage from search form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'search-content' => 'string|max:50'
        ]);

        $title = 'Votre recherche';

        $others = $this->randPost();

        $get = $request->get('t');

        if (isset($get) && $get != '')
            $search = $get;
        else
            $search = $request->input('search-content');

        $posts = Post::where('status','=','publish')
            ->where(function($query) use ($search){
                $query->where('title','like','%'.$search.'%')
                    ->orWhere('abstract','like','%'.$search.'%')
                    ->orWhere('content','like','%'.$search.'%');
            })
            ->latest('date')
            ->paginate($this->paginate);

        return view('front.search', compact('title', 'others', 'search', 'posts'));
    }
}
