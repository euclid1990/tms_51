@if (Session::has('flash_message'))
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-info-circle"> </i>  {!! Session::get('flash_message') !!}
</div>
@endif
