@extends('layouts.master')
@section('title', 'Gestion Client Paiement')
@section('style')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
@endsection
@section('title_toolbar', 'Edit Client Paiement')
@section('subtitle_toolbar', 'Gestion des Client Paiements')
@section('content')
    <div class="card">
        <div class="card-body">
            <form  method="POST" action="{{ route('customerpayements.update', $customerpayment->id) }}" id="editcustomerpayementform">
                @method('put')
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Paiement Client</h5>
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
                                <input type="text" value="{{$customerpayment->customer_invoice->num_customer_invoices}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Montant A Payer</label>
                                <input type="text" name="amount_to_be_paid" class="amount_to_be_paid" value="{{$customerpayment->amount_to_be_paid}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Montant Payer</label>
                                <input type="text" name="amount_to_pay" class="amount_to_pay" value="{{$customerpayment->amount_to_pay}}" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Reste a Payer</label>
                                <input type="text" name="reste" class="reste" value="{{$customerpayment->reste}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label>Note</label>
                                <textarea class="form-control" name="description_supplier_payment">{{$customerpayment->description_customer_payment}}</textarea>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button  class="btn btn-submit">Submit</button>
                <a href="{{ route('ventefactures.index') }}" class="btn btn-cancel">Close</a>
            </div>
        </form>

        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
$("#editcustomerpayementform").validate({
  rules: {
    amount_to_be_paid: {
          required:true,
          digits: true
      },
      amount_to_pay: {
          required:true,
          digits: true
      },
      reste:{
          required:true,
          digits: true
      },
  },
  messages:{
    amount_to_be_paid:{
          required: "Amount to be pay is required",
          digits: "Amount to be pay is numeric",
      },
      amount_to_pay:{
          required: "Amount to  pay is required",
          digits: "Amount to  pay is numeric",
      },
      reste:{
          required: "Reste is required",
          digits: "Reste min is numeric",
      },
  }
});
});
</script>
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
