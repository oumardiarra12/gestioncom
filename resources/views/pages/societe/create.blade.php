@extends('layouts.master')
@section('title', 'Gestion Societe')

@section('title_toolbar', 'Societe')
@section('subtitle_toolbar', 'Gestion des Societe')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('companies.store') }}" id="form"  enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom de Societe <span class="manitory">*</span></label>
                            <input type="text" name="company_name" value="{{$company->company_name}}" placeholder="Nom de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Sigle de Societe </label>
                            <input type="text" name="company_sigle" value="{{$company->company_sigle}}" placeholder="Sigle de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status Societe <span class="manitory">*</span></label>
                            <input type="text" name="company_status" value="{{$company->company_status}}" placeholder="Status de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>NIF Societe<span class="manitory">*</span></label>
                            <input type="text" name="company_nif" value="{{$company->company_nif}}" placeholder="NIF de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telephone Societe<span class="manitory">*</span></label>
                            <input type="text" name="company_contact" value="{{$company->company_contact}}" placeholder="Contact de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Fax Societe<span class="manitory">*</span></label>
                            <input type="text" name="company_fax" value="{{$company->company_fax}}" placeholder="Fax de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email de Societe<span class="manitory">*</span></label>
                            <input type="email" name="company_email" value="{{$company->company_email}}" placeholder="Email de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>BP de Societe<span class="manitory">*</span></label>
                            <input type="text" name="company_bp" value="{{$company->company_bp}}" placeholder="Boite Postal de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Activite de Societe<span class="manitory">*</span></label>
                            <input type="text" name="company_activity" value="{{$company->company_activity}}" placeholder="Activite de Societe">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Addresse de Societe<span class="manitory">*</span> </label>
                            <input type="text" name="company_address" value="{{$company->company_address}}" placeholder="Addresse de Societe">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <div class="image-uploads">
                                <img id="preview" src="#" alt="your image" class="mt-3"
                                    style="display:none;max-height: 250px;" />
                            </div>
                            <label for="selectImage"  class="btn text-white btn-warning me-2" >Choisir Logo <i class="fa fa-camera" data-bs-toggle="tooltip" title="fa fa-camera"></i> </label>
                            <input type="file" style="display: none;" class="form-control" name="company_logo"
                                @error('company_logo') is-invalid @enderror id="selectImage">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('home.index')}}" class="btn btn-cancel">Cancel</a>
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
