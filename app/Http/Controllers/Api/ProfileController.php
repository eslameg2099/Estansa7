<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Requests\Api\ProfileRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display the authenticated user resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show()
    {
        return auth()->user()->getResource();
    }

    /**
     * Update the authenticated user profile.
     *
     * @param \App\Http\Requests\Api\ProfileRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->allWithHashedPassword());

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        return $user->refresh()->getResource();
    }


    public function addaccountbank(Request $request)
    {

        $user = auth()->user();
        $user->update(['bank_name'=> $request->bank_name,'iban'=> $request->iban , 'account_bank'=> $request->account_bank ]); 
        return response()->json([
            'message' => "تم الاضافة بنجاح",
        ]);


    }


    public function showaccountbank(Request $request)
    {
        $user = auth()->user();
        return response()->json([
            'bank_name' => $user->bank_name,
            'iban' => $user->iban,
            'account_bank' => $user->account_bank,
        ]);

    }


   
}
