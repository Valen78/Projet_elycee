<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Accueil / Articles';

        $posts = Post::with('user','comments')
            ->latest('date')
            ->get();

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.posts.index', compact('posts', 'title'));
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
        $title = 'Accueil / Ajouter un article';

        $date = Carbon::now('Europe/Paris');

        $userId = Auth::user()->id;

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.posts.create', compact('userId', 'date', 'title'));
        else
            return redirect('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if(!is_null($request->file('picture')))
            $this->upload($request->file('picture'),$post->id);

        return redirect('admin/posts')->with('message','Article ajouté !');
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
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        $title = 'Accueil / Modifier un article';

        $post = Post::findOrFail($id);

        $date = Carbon::now('Europe/Paris');

        $userId = Auth::user()->id;

        if(Auth::user()->role == 'teacher')
            return view('front.admin.profs.posts.edit',compact('post', 'userId', 'date', 'title'));
        else
            return redirect('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $title = $post->title;

        if(!empty($request->input('deleteImg')))
        {
            $this->deletePicture($post);
            $post->update(['url_thumbnail'=>'']);
        }

        if(!is_null($request->file('picture')))
        {
            $this->deletePicture($post);
            $this->upload($request->file('picture'),$post->id);
        }

        $post->update($request->all());

        return redirect('admin/posts')->with(['message' => sprintf('Article %s bien mis à jour !!', $title)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ids)
    {
        $ids = explode(',',$ids);

        foreach($ids as $id)
        {
            $post = Post::findOrFail($id);

            $this->deletePicture($post);

            $post->delete();
        }

        return redirect('admin/posts')->with('message','Article(s) supprimé(s) !');
    }

    /**
     * Upload the picture in storage
     *
     * @param $im
     * @param $postId
     * @return bool
     */
    private function upload($im,$postId)
    {
        $ext = $im->getClientOriginalExtension();

        $uri = str_random(50).'.'.$ext;

        $post = Post::findOrFail($postId);

        $post->update([
            'url_thumbnail' => $uri
        ]);

        $im->move(env('UPLOAD_PICTURES','uploads'), $uri);

        return true;
    }

    /**
     * Remove the picture from storage
     *
     * @param Post $post
     * @return bool
     */
    private function deletePicture(Post $post)
    {
        if(!empty($post->url_thumbnail))
        {
            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $post->url_thumbnail;

            if (File::exists($fileName))
                File::delete($fileName);

            return true;
        }
        return false;
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

        Post::whereIn('id',$ids)->update(['status'=>$request->input('status')]);

        return redirect('admin/posts')->with('message', 'Article(s) bien mis à jour !!');
    }
}
