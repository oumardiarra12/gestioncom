@extends('layouts.master')
@section('title', 'Gestion Utilisateur')

@section('title_toolbar', 'Edit Utilisateur')
@section('subtitle_toolbar', 'Gestion des Utilisateurs')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('utilisateur.update',$user->id) }}" enctype="multipart/form-data">
                @method('put')
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
                                    <input type="text" name="firstname" value="{{$user->firstname}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Categorie</label>
                                    <select class="select" name="category_users_id">
                                        <option>Selectionner</option>
                                        @foreach ($categories as $categorie)
                                            <option @if($user->category_users_id ==  $categorie->id || old('category_users_id') == $categorie->id) selected @endif  value="{{ $categorie->id }}">{{ $categorie->name_category_users }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Prenom</label>
                                    <input type="text" name="lastname" value="{{$user->lastname}}">
                                </div>
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <div class="pass-group">
                                        <input type="text"  name="telephone" value="{{$user->telephone}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Adresse</label>
                                    <div class="pass-group">
                                        <input type="text"  name="addresse" value="{{$user->addresse}}">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="selectImage"  class="btn text-white btn-warning me-2" >Choisir Image <i class="fa fa-camera" data-bs-toggle="tooltip" title="fa fa-camera"></i> </label>
                                    <input type="file" style="display: none;" class="form-control" value="{{$user->image}}" name="image"
                                        @error('image') is-invalid @enderror id="selectImage">
                                    <div class="image-uploads">
                                        <img id="preview" src="users/{{$user->image}}" alt="your image" class="mt-3"
                                            style="max-height: 250px;" />
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
