@extends('layouts.master')
@section('title', 'Gestion Utilisateur')
@section('style')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
@endsection
@section('title_toolbar', 'Nouveau Utilisateur')
@section('subtitle_toolbar', 'Gestion des Utilisateurs')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('utilisateur.store') }}" enctype="multipart/form-data" id="userform">
                @csrf
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
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" name="firstname">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Categorie</label>
                                    <select class="js-example-basic-single select2" name="category_users_id">
                                        <option value="">Selectionner</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name_category_users }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mot de Passe</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password" id="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Prenom</label>
                                    <input type="text" name="lastname">
                                </div>
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <div class="pass-group">
                                        <input type="text"  name="telephone">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Adresse</label>
                                    <div class="pass-group">
                                        <input type="text"  name="addresse">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirme Mot de Passe</label>
                                    <div class="pass-group">
                                        <input type="password"  name="password_confirmation" id="confirmpassword">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="selectImage"  class="btn text-white btn-warning me-2" >Choisir Image <i class="fa fa-camera" data-bs-toggle="tooltip" title="fa fa-camera"></i> </label>
                                    <input type="file" style="display: none;" class="form-control" name="image"
                                        @error('image') is-invalid @enderror id="selectImage">
                                    <div class="image-uploads">
                                        <img id="preview" src="#" alt="your image" class="mt-3"
                                            style="display:none;max-height: 250px;" />
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-submit me-2" value="Valider" />
                        <a href="{{ route('utilisateur.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>

        </div>
    </div>
    </form>
    </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
$("#userform").validate({
  rules: {
    firstname:"required",
    lastname:"required",
    telephone:"required",
    addresse:"required",
    category_users_id:"required",
    email: {
          required:true,
          email: true,
        //   unique:true
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
        //   digits: "Phone is numeric",
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
