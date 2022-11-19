<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Models\Provider;
use App\Models\CategoryPost;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Dashboard\PostRequest;


class PostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Posts = Post::with('user','category')->filter()->OrderByDESC('id')->paginate(10);
        return view('dashboard.posts.index', compact('Posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Providers = Provider::select('id','name')->get();
        $CategoryPosts = CategoryPost::select('id','name')->get();
        return view('dashboard.posts.create', compact('Providers','CategoryPosts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $Post = Post::create($request->all());
       $Post->addAllMediaFromTokens();
       flash()->success(trans('posts.messages.created'));
       return redirect()->route('dashboard.posts.show', $Post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $Providers = Provider::select('id','name')->get();
        $CategoryPosts = CategoryPost::select('id','name')->get();
        return view('dashboard.posts.edit', compact('Providers','CategoryPosts','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        $post->addAllMediaFromTokens();

        flash()->success(trans('posts.messages.updated'));

        return redirect()->route('dashboard.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash()->success(trans('posts.messages.deleted'));

        return redirect()->route('dashboard.posts.index');
    }
}
