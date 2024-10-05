<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $user){
        return view('user.profile',compact('user'));
    }

    public function edit(User $user){
        return view('user.edit',compact('user'));
    }

    public function update(UpdateUserProfileRequest $request,User $user){
     

        $data = $request->safe()->collect();


    if (empty($data['password'])) {
        unset($data['password']);
        unset($data['current-password']);
    } else {
        $data['password'] = Hash::make($data['password']);
    }


    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('users', 'public');
        $data->put('image', '/storage/app/public/' . $path); 
    }

    
    if ($request->input('status') === 'public') {
        $data->put('private_account', 0); 
    } else {
        $data->put('private_account', 1);
    }

    session()->flash('success',__('Your Profile has been Updated!'));

    $user->update($data->toArray());

 
    return redirect()->route('user_profile', $user);
    }
}
