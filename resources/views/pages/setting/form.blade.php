<x-layout>
    <x-card>
        <x-form :model="$model">
            <x-action form="form" />

            @bind($model)
                <x-form-input col="6" value="{{ env('APP_NAME') }}" name="name" />
                <x-form-input col="6" value="{{ env('APP_TITLE') }}" name="title" />
            @endbind

        </x-form>
    </x-card>
</x-layout>
