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
        $user=User::findOrFail(Auth::user()->id);
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
        if($request->filled('password')){
            $user->update(['password' => bcrypt($request->password)]);
        }
        unset($request['id']);
		if (!$request->password) {
	        unset($request['password']);
		}
        unset($request['password_confirmation']);

        $user->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            // 'image'=>"nullable",
            'telephone'=>$request->telephone,
            'addresse'=>$request->addresse,
           //'password'=>$request->password,
            'email'=>$request->email,
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('profile');
    }
}
