@extends(Template::master())

@section('title')
{{ $label }}
@endsection

@section('container')
<div class="container-fluid">
    {{ $slot }}
</div>
@endsection
