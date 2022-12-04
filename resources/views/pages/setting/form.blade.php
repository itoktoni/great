<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action>
                <x-button type="submit" label="Save" />
            </x-action>

            @bind($model)
                <x-form-input col="6" value="{{ env('APP_NAME') }}" name="name" />
                <x-form-input col="6" value="{{ env('APP_TITLE') }}" name="title" />
            @endbind

        </x-card>
    </x-form>
    <x-script-form />
</x-layout>