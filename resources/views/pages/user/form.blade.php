<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action>
                <x-button type="submit" label="Save" />
            </x-action>

            @bind($model)
                <x-form-input col="3" name="name" />
                <x-form-input col="3" class="date" name="username" />
                <x-form-select col="6" class="search" name="vendor" :options="$vendor" />
                <x-form-input col="6"  type="date" name="phone" />
                <x-form-input col="6" name="email" />
                <x-form-select col="6" name="role" :options="$roles" />
                <x-form-input col="6" name="password" type="password"/>
            @endbind

        </x-card>
    </x-form>
    <x-script-form />
</x-layout>
