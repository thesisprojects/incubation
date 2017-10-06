@if(Session::has('autherror'))
    <div class="alert alert-danger" role="alert">
        <b>AUTH:</b> {{ Session::get('autherror') }}</p>
    </div>
@endif