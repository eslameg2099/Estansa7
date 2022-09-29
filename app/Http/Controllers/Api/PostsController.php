<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Resources\PostResource;

use App\Http\Requests\Api\PostRequest;
use App\Http\Requests\Api\UpdatePostRequest;


class PostsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * EstateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Posts = Post::active()->simplePaginate();
        return PostResource::collection($Posts);
    }


    public function getMyposts()
    {
        $posts = auth()->user()->posts()->simplePaginate();
        return PostResource::collection($posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $request->user()->posts()->create($request->all());
        $post->uploadFile('image');
        return new PostResource($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->firstorfail(); 
        $post->incrementReadCount();
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,$slug)
    {
        $post = $request->user()->posts()->where('slug',$slug)->firstorfail(); 
        $post->update($request->all());
        $post->uploadFile('image');
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$slug)
    {
        $post = $request->user()->posts()->where('slug',$slug)->firstorfail(); 
        $post->delete();
        return response()->json([
            'message' => "تم الحذف بنجاح",
        ]);
    }

    public function favorite(Post $post)
    {
        auth()->user()->toggleFavorite($post); // The user added to favorites this meal;

        return new PostResource($post);
    }

    public function list_favorite()
    {
        $posts = auth()->user()->favorite(Post::class); // The user added to favorites  kitchens;

        return PostResource::collection($posts);
    }
}
