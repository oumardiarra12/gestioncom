@extends('layouts.master')
@section('title', "Détail de l'utilisateur")
@section('style')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
@endsection
@section('title_toolbar', "Détail de l'Utilisateur")
@section('subtitle_toolbar', 'Gestion des Utilisateurs')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('utilisateur.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <form method="POST" action="{{ route('profile.update') }}"  enctype="multipart/form-data" id="profiluser">
            @method('put')
            @csrf
        <div class="card-body">
            <div class="profile-set">
                <div class="profile-head">
                </div>
                <div class="profile-top">
                    <div class="profile-content">
                        <div class="profile-contentimg">
                            <img src="{{ asset('/storage/users/'.$user->image) }}" alt="img" id="blah">
                            <div class="profileupload">
                                <input type="file" name="image" id="imgInp">
                                <a href="javascript:void(0);"><img src="assets/img/icons/edit-set.svg" alt="img"></a>
                            </div>
                        </div>
                        <div class="profile-contentname">
                            <h2>{{$user->firstname}} {{$user->lastname}}</h2>
                            <h4>{{$user->CategoryUser->name_category_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="firstname" value="{{Auth::user()->firstname}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Prenom</label>
                        <input type="text" name="lastname" value="{{Auth::user()->lastname}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{Auth::user()->email}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" name="telephone" value="{{Auth::user()->telephone}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" name="addresse" value="{{Auth::user()->addresse}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Mot de Passe</label>
                        <div class="pass-group">
                            <input type="password" class="pass-input" name="password">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Confirmation Mot de Passe</label>
                        <div class="pass-group">
                            <input type="password" name="password_confirmation" class="pass-input">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button  type="submit" class="btn btn-submit me-2">Update</button>
                    <a href="{{route('home.index')}}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
$("#profiluser").validate({
  rules: {
    firstname:"required",
    lastname:"required",
    telephone:{
        required:true,
        digits:true
    },
    addresse:"required",
    category_users_id:"required",
    email: {
          required:true,
          email: true,
      },
      password: {
          required:true,

      },
      password_confirmation:{
        required:true,
        equalTo: "#password"
      }
  },
  messages:{
    firstname:{
          required: "First Name is required",
      },
      lastname:{
          required: "Last Name is required",
      },
      telephone:{
          required: "Phone is required",
          digits: "Phone is numeric",
      },
      addresse:{
          required: "Address is required",
      },
      category_users_id:{
          required: "Category is required",
      },
      email:{
          required: "Email is required",
          email:"Email is Email"
      },
      password:{
          required: "Password is required",
      },
      password_confirmation:{
          required: "Password Confirm is required",
          equalTo:"not Correspond"
      },
  }
});
});
</script>
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
