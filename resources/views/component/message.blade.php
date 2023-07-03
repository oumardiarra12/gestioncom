@if ($message = Session::get('warning'))
<div  class="btn btn-primary waves-effect waves-light" id="timeout">
	<strong>{{ $message }}</strong>
</div>

@endif
