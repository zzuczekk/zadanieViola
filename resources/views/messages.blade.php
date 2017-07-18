@if(Session::has($name))
    <div class="alert alert-success card">
        {{Session::get($name)}}
    </div>
@endif