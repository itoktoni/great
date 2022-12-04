@extends(Template::master())

@section('title')
<h4>Tiket System</h4>
@endsection

@section('action')
<div class="button">
	<input class="btn-check-m d-lg-none" type="checkbox">
	@if(auth()->user()->type > RoleLevel::Admin)
	<a href="{{ route(SharedData::get('route').'.postDelete') }}" class="btn btn-danger button-delete-all">
		{{ __('Delete') }}
	</a>
	@endif
	<a href="{{ route(SharedData::get('route').'.getCreate') }}" class="btn btn-success">
		Create
	</a>
</div>
@endsection

@section('container')

<div class="page-header">
	<div class="header-container container-fluid d-sm-flex justify-content-between">
		@yield('title')
		@yield('action')
	</div>
</div>

<div class="card">
	<div class="card-body">

		{!! Template::form_table() !!}

		<div class="form-group col-md-2">
			<input type="text" name="date" value="{{ request()->get('date') ?? null }}" class="form-control date"
				placeholder="{{ __('Pilih Tanggal') }}">
		</div>

		<div class="form-group col-md-2">
			<div class="form-group {{ $errors->has('ticket_system_work_type_id') ? 'has-error' : '' }}">
				{!! Form::select('ticket_system_work_type_id', $type, request()->get('ticket_system_work_type_id') ?? null, ['class' => 'form-control', 'id' =>
				'ticket_system_work_type_id', 'placeholder' => '- Pilih Type -']) !!}
			</div>
		</div>

		<div class="form-group col-md-3">
			<select name="filter" class="form-control">
				<option value="">- {{ __('Search Default Data') }} -</option>

				<option value="ticket_system_code">
					Kode</option>
				<option value="name">
					Reported By</option>
				<option value="ticket_topic_name">
					Topic</option>
				<option value="location_name">
					Nama Ruangan</option>
				<option value="ticket_system_description">
					Deskripsi</option>
				<option value="ticket_system_priority">
					Priority</option>

			</select>
		</div>

		<div class="form-group col">
			<div class="input-group">
				<input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
					placeholder="{{ __('Searching') }} Data">
				<div class="input-group-append">
					<button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
				</div>
			</div>
		</div>

		{!! Template::form_close() !!}
		@includeIf(Template::form(SharedData::get('template'),'data'))

		@component(Template::components('pagination'), ['data' => $data])
		@endcomponent

	</div>
</div>
@endsection

@push('javascript')
@include(Template::components('table'))
@include(Template::components('date'))

<script src="{{ url('assets/js/stacktable.js') }}"></script>
<script>
$('.table').cardtable();
</script>

<style>
.stacktable { width: 100%; }
.st-head-row { padding-top: 1em; }
.st-head-row.st-head-row-main { font-size: 1.5em; padding-top: 0; }
.st-key { width: 35%; text-align: left; padding-right: 1%; }
.st-val { width: 70%; padding-left: 1%; }



/* RESPONSIVE EXAMPLE */

.stacktable.large-only { display: table; }
.stacktable.small-only { display: none; }

@media (max-width: 800px) {
  .stacktable.large-only { display: none; }
  .stacktable.small-only { display: table; }
}

h2 {
  text-align: center;
  padding-top: 10px;
}

table caption {
	padding: .5em 0;
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
</style>

@endpush