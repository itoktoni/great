@if ($errors->any())
<script type="text/javascript">
$(function() {
    @foreach($errors->all() as $error)

        toastr.error('{{ $error }}');

    @endforeach
});
</script>
@endif

@if(session()->has('success') && !request()->ajax())
<script type="text/javascript">
$(function() {
    toastr.success("{{ session()->get('success') }}");
});
</script>
@php
session()->forget('success');
@endphp
@endif

@if(session()->has('error') && !request()->ajax())
<script type="text/javascript">
$(function() {
    toastr.error("{{ session()->get('error') }}");
});
</script>
@php
session()->forget('error');
@endphp
@endif