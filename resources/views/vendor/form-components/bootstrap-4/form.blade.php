<form action="{{ $action }}" method="{{ $spoofMethod ? 'POST' : $method }}" {!! $attributes->merge([
    'class' => $hasError() ? 'form-submit needs-validation' : 'form-submit needs-validation'
]) !!}>

@unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
    @csrf
@endunless

@if($spoofMethod)
    @method($method)
@endif

@if(!request()->ajax())
<div class="page-action">
    <h5 class="action-container">
        <div class="button">
            @yield('action')
        </div>
    </h5>
</div>
@endif

    {!! $slot !!}

    @if(request()->ajax())
        <div class="modal-footer" id="modal-footer">
            @yield('action')
        </div>
    @endif

    @once
    @push('footer')
        @stack('javascript')
    @endpush
    @endonce

</form>
