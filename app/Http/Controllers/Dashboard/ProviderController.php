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
use Illuminate\Support\Facades\Http;

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
        $provider->update($request->allWithHashedPassword());

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
    public function destroy(Provider $provider)
    {
        $provider->forceDelete();

        flash()->success(trans('provider.messages.deleted'));

        return redirect()->route('dashboard.providers.index');
    }


    public function sendactive($id)
    {
        $provider = Provider::find($id);
        return view('dashboard.accounts.providers.sendactive', compact('provider'));
    }

    public function senddeactive($id)
    {
        $provider = Provider::find($id);
        return view('dashboard.accounts.providers.senddeactive', compact('provider'));
    }


    public function active(Request $request)
    {
        $provider = Provider::findorfail($request->id);
        $provider->phone_verified_at =now();
        $provider->provider_verified_at =now();
        $provider->save();

        $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
            'user' => $provider->name,
            'code'=> $provider->id,
            'email'=>$provider->email,
            'type'=>'activeprovider',
            'title'=>'تم قبولك في المنصة ',
            'message'=>$request->textmail,
            
        ]); 


        flash()->success('تم بنجاح');
        return redirect()->route('dashboard.providers.index');
    }


    public function disactive(Request $request)
    {
        $provider = Provider::findorfail($request->id);
        $provider->phone_verified_at = null;
        $provider->provider_verified_at =null;
        $provider->save();

        $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
            'user' => $provider->name,
            'code'=> $provider->id,
            'email'=>$provider->email,
            'type'=>'deactiveprovider',
            'title'=>'نعتز عن عدم قبول حسابك',
            'message'=>$request->textmail,
            
        ]); 


        flash()->success('تم بنجاح');
        return redirect()->route('dashboard.providers.index');
    }
}
