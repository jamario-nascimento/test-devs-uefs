@if (Session::has('message'))
    <div id="message" class="alert {{Session::get('class')}} alert-dismissible fade show">
        {{ Session::get('message') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif