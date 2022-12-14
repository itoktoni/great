@props([
    'label' => null,
    'model' => null,
    'form' => null,
    'override' => false
    ])

    @php
        $attributes = $attributes->class([
        'button',
        ])->merge([
        //
        ]);

        if($form == null){
        $form = 'table';
        }
    @endphp

    @section('action')
    <div {{ $attributes }}>

        @if($form == 'table')
            <input class="btn-check-m d-lg-none" type="checkbox">
            <x-button onclick="return confirm('Apakah anda yakin ingin menghapus ?')" name="delete" type="submit" color="danger" label="Delete"/>
            <x-button module="getCreate" color="success" label="Create" />
        @elseif($form == 'form')
            <x-button type="submit" label="Save" />
        @endif

        {{ $slot }}
    </div>
    @endsection
