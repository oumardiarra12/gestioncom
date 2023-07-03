@extends('layouts.master')
@section('title', 'Gestion Fournisseur Paiement')

@section('title_toolbar', 'Nouveau Fournisseur Paiement')
@section('subtitle_toolbar', 'Gestion desFournisseur Paiements')
@section('content')
    <div class="card">
        <div class="card-body">
            <form  method="POST" action="{{ route('supplierpayements.store', $purchaseinvoice->id) }}">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">Create Paiement Fournisseur</h5>
            </div>
            <div class="modal-body">

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
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Reference Facture</label>
                                <input type="text" value="{{$purchaseinvoice->num_purchase_invoice}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Montant A Payer</label>
                                <input type="text" name="amount_to_be_paid" class="amount_to_be_paid" value="{{$purchaseinvoice->total_purchase_invoice}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Montant Payer</label>
                                <input type="text" name="amount_to_pay" class="amount_to_pay" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Reste a Payer</label>
                                <input type="text" name="reste" class="reste" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label>Note</label>
                                <textarea class="form-control" name="description_supplier_payment"></textarea>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button  class="btn btn-submit">Submit</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </form>

        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {


        $('.amount_to_pay').on('keyup', function() {
            var montantpayer = $('.amount_to_pay').val() ;
            var montantapayer =  $('.amount_to_be_paid').val();
            var reste = montantapayer - montantpayer;
            $('.reste').val(reste);
        });


    });
</script>
@endsection
