@if ($errors->any())
    <br>
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <b>VALIDATION:</b> {{ $error }}
        </div>
    @endforeach
@endif
