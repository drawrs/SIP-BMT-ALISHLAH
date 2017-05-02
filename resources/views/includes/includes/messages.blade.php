@if(Session::has('message'))
<div class="row">
    <div class="col-md-8">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Info!</h4>
            {{ Session::get('message') }}
        </div>
    </div>
</div>
@endif