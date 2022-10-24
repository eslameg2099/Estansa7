<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryPost;
use App\Jobs\updatepostdeactiveJob;
use App\Jobs\updatepostactiveJob;
use App\Http\Requests\Dashboard\CategoryPostRequest;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryPosts = CategoryPost::filter()->OrderByDESC('id')->paginate(10);
        return view('dashboard.categorypost.index', compact('CategoryPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categorypost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryPostRequest $request)
    {
        $CategoryPost = CategoryPost::create($request->all());

        $CategoryPost->addAllMediaFromTokens();

        flash()->success(trans('categorypost.messages.created'));

        return redirect()->route('dashboard.categorypost.show', $CategoryPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryPost $categorypost)
    {
        return view('dashboard.categorypost.show', compact('categorypost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryPost $categorypost)
    {
         return view('dashboard.categorypost.edit', compact('categorypost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryPost $categorypost)
    {
        $categorypost->update($request->all());

        $categorypost->addAllMediaFromTokens();

        flash()->success(trans('categorypost.messages.updated'));

        return redirect()->route('dashboard.categorypost.show', $categorypost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryPost $categorypost)
    {
        $categorypost->delete();

        flash()->success(trans('categorypost.messages.deleted'));

        return redirect()->route('dashboard.categorypost.index');
    }


    public function deactive(CategoryPost $categorypost)
    {
        $categorypost->update(['stauts' => '0']);
        updatepostdeactiveJob::dispatch($categorypost);
        flash()->success('تم بنجاح');
    }


    public function active(CategoryPost $categorypost)
    {
        $categorypost->update(['stauts' => '1']);
        updatepostactiveJob::dispatch($categorypost);
        flash()->success('تم بنجاح');
    }
}
