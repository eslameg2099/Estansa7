<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProvider;
use App\Http\Requests\Dashboard\CategoryProviderRequest;


class CategoryProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryProvideres = CategoryProvider::where('parent_id',null)->filter()->OrderByDESC('id')->paginate(10);
        return view('dashboard.categoryprovider.index', compact('CategoryProvideres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categoryprovider.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryProviderRequest $request)
    {
        $CategoryProvider = CategoryProvider::create($request->all());

        $CategoryProvider->addAllMediaFromTokens();

        flash()->success(trans('categoryprovider.messages.created'));

        return redirect()->route('dashboard.categoryprovider.show', $CategoryProvider);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProvider $categoryprovider)
    {
        $categories =   CategoryProvider::where('parent_id',$categoryprovider->id)->get();
        $count  =   count($categoryprovider->parents);
        return view('dashboard.categoryprovider.show', compact('categoryprovider','categories','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProvider $categoryprovider)
    {
        return view('dashboard.categoryprovider.edit', compact('categoryprovider'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,CategoryProvider $categoryprovider)
    {
        $categoryprovider->update($request->all());

        $categoryprovider->addAllMediaFromTokens();

        flash()->success(trans('categoryprovider.messages.updated'));

        return redirect()->route('dashboard.categoryprovider.show', $categoryprovider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProvider $categoryprovider)
    {
        $categoryprovider->delete();

        flash()->success(trans('categoryprovider.messages.deleted'));

        return redirect()->route('dashboard.categoryprovider.index');
    }

    public function trashed()
    {
        $CategoryProvideres = categoryprovider::onlyTrashed()->paginate();

        return view('dashboard.categoryprovider.trashed', compact('CategoryProvideres'));
    }

    public function showTrashed(CategoryProvider $categoryprovider)
    {
        
        return view('dashboard.categoryarcheticture.show', compact('categoryprovider'));
    }

    public function restore($id)
    {
        $categoryprovider =  CategoryProvider::withTrashed()->findorfail($id);
        $categoryprovider->restore();
        flash()->success(trans('categoryprovider.messages.restored'));
        return redirect()->route('dashboard.categoryprovider.trashed');

    }

    public function forceDelete($id)
    {

        $categoryprovider =  CategoryProvider::withTrashed()->findorfail($id);

        $categoryprovider->forceDelete();

        flash()->success(trans('categoryprovider.messages.deleted'));

        return redirect()->route('dashboard.categoryprovider.trashed');
    }
}
