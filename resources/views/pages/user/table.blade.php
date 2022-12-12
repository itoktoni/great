<x-layout>

    <x-action>
        <input class="btn-check-m d-lg-none" type="checkbox">
        <x-button hx-boost="false" module="postDelete" color="danger" label="Delete" class="button-delete-all" />
        <x-button module="getCreate" color="success" label="Create" />
    </x-action>

    <x-form method="GET" action="{{ moduleRoute('getTable') }}">

        <x-card>

            <x-filter toggle="Filter" :fields="$fields"/>

            <div class="col-md-12">
                <div class="table-responsive" id="table_data">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="9" class="center">
                                    <input class="btn-check-d" type="checkbox">
                                </th>
                                <th class="text-center column-action">{{ __('Action') }}</th>
                                @foreach($fields as $value)
                                    <th {{ Template::extractColumn($value) }}>
                                        @if($value->sort)
                                            @sortablelink($value->code, __($value->name))
                                            @else
                                                {{ __($value->name) }}
                                            @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $table)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="code[]"
                                            value="{{ $table->field_primary }}">
                                    </td>
                                    <td class="col-md-2 text-center column-action">
                                        <x-crud :model="$table"/>
                                    </td>
                                    <td>{{ $table->field_name }}</td>
                                    <td>{{ $table->field_username }}</td>
                                    <td>{{ $table->field_role_name }}</td>
                                    <td>{{ $table->has_vendor->field_name ?? '' }}
                                    </td>
                                    <td>{{ $table->field_phone }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <x-pagination :data="$data" />
            </div>

        </x-card>

    </x-form>

    <x-script-table />

</x-layout>
