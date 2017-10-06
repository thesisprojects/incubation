@if(Session::has('exception'))
    <div class="alert alert-danger" role="alert">
        <b>FATAL:</b> {{ Session::get('exception') }}
    </div>
@endif