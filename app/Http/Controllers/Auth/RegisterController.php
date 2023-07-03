<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\CategoryUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function index(){
        $users=User::all();
        $categories=CategoryUser::all();
        return view('pages.users.index',compact('users','categories'));
    }
    public function create(){
        $categories=CategoryUser::all();
        return view('pages.users.create',compact('categories'));
    }

    public function store(StoreUserRequest $request)
    {
        $imageName="";
        if($request->file('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/users', $imageName);
        }else {
            $imageName="default.jpg";
        }
        User::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'image'=>$imageName,
            'telephone'=>$request->telephone,
            'addresse'=>$request->addresse,
            'category_users_id'=>$request->category_users_id,
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function show($id){
        $user=User::findOrFail($id);
        return view('pages.users.show',compact('user'));
    }
    public function edit($id){
        $user=User::findOrFail($id);
        $categories=CategoryUser::all();
        return view('pages.users.edit',compact('user','categories'));
    }
    public function update(UpdateUserRequest $request,$id){
        $user=User::findOrFail($id);
        $imageName="";
        if($request->file('image')){
            $image_path = public_path('users/'.$user->image);
            if(file_exists($image_path)){
              unlink($image_path);
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/users', $imageName);
            $user->image=$imageName;
            $user->save();
        }
        $user->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            //'image'=>$imageName,
            'telephone'=>$request->telephone,
            'addresse'=>$request->addresse,
            'category_users_id'=>$request->category_users_id,
            'email'=>$request->email,
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('utilisateur.index');
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $image_path = public_path('users/'.$user->image);
        if(file_exists($image_path)){
          unlink($image_path);
        }
        $user->delete();

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
}
