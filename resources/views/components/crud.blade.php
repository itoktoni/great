@props([
    'action' => ['update', 'delete'],
    'model' => null,
])

<div {{ $attributes }}>
    @foreach ($action as $act)
    @switch($act)
        @case('update')
        <x-button module="getUpdate" key="{{ $model->field_primary }}" color="primary"
            icon="pencil-square" />
            @break
        @case('delete')
        <x-button module="postDelete" key="{{ $model->field_primary }}" color="danger"
            icon="trash3" hx-boost="false" class="button-delete" />
            @break
        @default
    @endswitch
    @endforeach
{{ $slot }}
</div>