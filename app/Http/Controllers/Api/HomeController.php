<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProvider;
use App\Http\Resources\CategoryProviderResource;
use App\Models\Provider;
use App\Http\Resources\miniproviderResource;
use App\Models\Post;
use App\Http\Resources\PostResource;

use App\Models\Review;
use App\Http\Resources\ReviewResource;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  

      return  $request->ip();
        $CategoryProviders = CategoryProvider::active()->inRandomOrder()->limit(6)->get();

        $Providers_computerscience = Provider::active()->whereHas('categories', function ($builder) {
            $builder->where('category_provider_id', 1);
        })->inRandomOrder()->limit(8)->get();

        $Providers_wirte = Provider::active()->whereHas('categories', function ($builder){
            $builder->where('category_provider_id', 2);
        })->inRandomOrder()->limit(8)->get();

        $Providers_management = Provider::active()->whereHas('categories', function ($builder) {
            $builder->where('category_provider_id', 3);
        })->inRandomOrder()->limit(8)->get();

        $Posts = Post::active()->inRandomOrder()->limit(4)->get();
        $Reviews = Review::inRandomOrder()->limit(6)->get();
        return response()->json([
            'data' => [
                'categoryProviders'=> CategoryProviderResource::collection($CategoryProviders),
                'Providers_computerscience'=> miniproviderResource::collection($Providers_computerscience),
                'Providers_wirte'=> miniproviderResource::collection($Providers_wirte),
                'Providers_management'=> miniproviderResource::collection($Providers_management),
                'reviews' => ReviewResource::collection($Reviews),
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
