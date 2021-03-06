@if (session('status'))
<div id="divAlertSuccess" class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><span><i class="fa fa-check"></i></span> {{ __('messages.success') }}</h4>
    <h5>{{ session('status') }}</h5>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <span><i class="fa fa-exclamation-triangle"></i></span>
    {{ session('warning') }}
</div>
@endif

@if (session('errors'))
<div id="divErrors" class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><span><i class="fa fa-ban"></i></span> {{ __('messages.error') }}</h4>
    <h5 id="errorMsg">{!! session('errors') !!}</h5>
</div>
@endif
