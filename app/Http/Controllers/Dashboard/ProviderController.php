<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\CategoryProvider;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\ProviderRequest;

class ProviderController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::withCount('Reservations')->filter()->OrderByDESC('id')->paginate();
        return view('dashboard.accounts.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CategoryProvideres = CategoryProvider::select('id','name')->whereNotNull('parent_id')->get();
        return view('dashboard.accounts.providers.create', compact('CategoryProvideres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $provider = Provider::create($request->all());
        $provider->password =  Hash::make($request->password);
        $provider->phone_verified_at = now();
        $provider->provider_verified_at = now();
        $provider->save();
        $provider->addAllMediaFromTokens();

        flash()->success(trans('provider.messages.created'));

        return redirect()->route('dashboard.providers.show', $provider);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('dashboard.accounts.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $CategoryProvideres = CategoryProvider::select('id','name')->whereNotNull('parent_id')->get();
        return view('dashboard.accounts.providers.edit', compact('CategoryProvideres','provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        $provider->addAllMediaFromTokens();

        flash()->success(trans('provider.messages.updated'));

        return redirect()->route('dashboard.providers.show', $provider);
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


    public function active($id)
    {
        $provider = Provider::findorfail($id);
        $provider->phone_verified_at =now();
        $provider->provider_verified_at =now();
        $provider->save();
        flash()->success('تم بنجاح');
        return redirect()->back();
    }


    public function disactive($id)
    {
        $provider = Provider::findorfail($id);
        $provider->phone_verified_at = null;
        $provider->provider_verified_at =null;
        $provider->save();
        flash()->success('تم بنجاح');
        return redirect()->back();
    }
}
