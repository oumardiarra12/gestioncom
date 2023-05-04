<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile(){
        $user=Auth::user();
        return view('pages.users.profile',compact('user'));
    }
    public function update(UpdateProfileRequest $request){
        $user=Auth::user();
        $imageName="";
        if($request->file('image')){
            $image_path = public_path('users/'.$user->image);
            if(file_exists($image_path)){
              unlink($image_path);
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('users'), $imageName);
            $user->image=$imageName;
            $user->save();
        }
        $user->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'password'=>$request->password,
            'telephone'=>$request->telephone,
            'addresse'=>$request->addresse,
            'email'=>$request->email,
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('profile');
    }
}
