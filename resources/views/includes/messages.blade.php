@if(Session::has('message'))
<div class="callout callout-{{Session::get('type')}}">
    <h4>Info</h4>
    <p>{{ Session::get('message')}}</p>
</div>
@endif