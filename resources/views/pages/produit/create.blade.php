@extends('layouts.master')
@section('title', 'Gestion Produit')

@section('title_toolbar', 'Nouveau Produit')
@section('subtitle_toolbar', 'Gestion des Produits')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data" id="form">
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
                    <div class="col-lg-6 col-sm-6 col-12">
                        {{-- <div class="form-group">
                           <svg id="codebar"></svg>
                        </div> --}}
                        <div class="form-group">
                            <label>Nom Produit</label>
                            <input type="text" class="form-control" name="name_product">
                        </div>
                        <div class="form-group">
                            <label>Categorie</label>
                            <select class="js-example-basic-single select2" name="category_id">
                                <option>Selectionner</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name_category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Prix Vente</label>
                            <div class="pass-group">
                                <input type="number" class="form-control"  name="price_sale">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stock Min</label>
                            <div class="pass-group">
                                <input type="number" class="form-control" name="stock_min">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Code Barre</label>
                            <input type="text" id="textcodebar" class="form-control" name="codebarre_product">
                        </div>
                        <div class="form-group">
                            <label>Unite</label>
                            <select class="select" name="units_id">
                                <option>Selectionner</option>
                                @foreach ($unites as $unite)
                                    <option value="{{ $unite->id }}">{{ $unite->name_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Prix Achat</label>
                            <input type="number" class="form-control" name="price_purchase">
                        </div>

                        <div class="form-group">
                            <label>Stock Stock</label>
                            <div class="pass-group">
                                <input type="number" class="form-control" name="stock_actuel" readonly>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_product"></textarea>
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
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
                <a href="{{ route('produits.index') }}" class="btn btn-cancel">Cancel</a>
            </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
{{-- <script>
    document.getElementById("barcode").addEventListener("onchange", () => {
    let text = document.getElementById("textcodebar").value;
    JsBarcode("#barcode", text);
});
</script> --}}
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
