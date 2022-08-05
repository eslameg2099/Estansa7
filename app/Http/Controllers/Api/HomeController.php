<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProvider;
use App\Http\Resources\CategoryProviderResource;
use App\Models\Provider;
use App\Http\Resources\providerResource;
use App\Models\Post;
use App\Http\Resources\PostResource;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryProviders = CategoryProvider::active()->inRandomOrder()->limit(4)->get();
        $Providers = Provider::inRandomOrder()->limit(4)->get();
        $Posts = Post::active()->inRandomOrder()->limit(4)->get();
        return response()->json([
            'data' => [
               
                'categoryProviders'=> CategoryProviderResource::collection($CategoryProviders),
                'providers'=> providerResource::collection($Providers),
                'posts'=> PostResource::collection($Posts),
            ],
        ]);

        
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
