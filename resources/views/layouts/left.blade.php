<div class="navigation-menu-tab">
	<div class="flex-grow-1">
		<ul>
			<li>
				<a class="icon {{ request()->segment(1) == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
					<i class="bi bi-bar-chart-line"></i>
					<h5 class="text-center text-white">
						Dashboard
					</h5>
				</a>
			</li>
			@if($groups = module('groups'))
			@foreach($groups as $group_data)
			<li>
				<a class="icon {{ request()->segment(2) == $group_data->field_primary ? 'active' : '' }}" href="{{ $group_data->field_url ?? '#' }}"
					data-nav-target="#{{ $group_data->field_primary }}">
					<i class="bi bi-{{ $group_data->field_icon }}"></i>
					<h5 class="text-center text-white">
						{{ __($group_data->field_name) }}
					</h5>
				</a>
			</li>
			@endforeach
			@endif

			<li>
				@auth
				<a target="_blank" class="icon" href="{{ asset('storage/doc.pdf') }}">
					<i class="bi bi-question-circle"></i>
					<h5 class="text-center text-white">
						Manual Book
					</h5>
				</a>
				@endauth
			</li>

			<li>
				@auth
				<a  hx-boost="false" class="icon" href="{{ route('logout') }}">
					<i class="bi bi-person-x"></i>
					<h5 class="text-center text-white">
						Logout
					</h5>
				</a>
				@else
				<a class="icon" href="{{ route('login') }}">
					<i class="bi bi-log-in"></i>
					<h5 class="text-center text-white">
						Login
					</h5>
				</a>
				@endauth
			</li>

		</ul>
	</div>
</div>

@if(Template::greatherAdmin())
<!-- begin::navigation menu -->
<div class="navigation-menu-body" data-turbolinks="false">

	<!-- begin::navigation-logo -->
	<div class="navigation-header">
		<div id="navigation-logo">
			<a href="{{ url('/') }}">
				<img class="logo"
					src="{{ env('APP_LOGO') ? url('storage/'.env('APP_LOGO')) : url('assets/media/image/logo.png') }}"
					alt="logo">
			</a>
		</div>
	</div>
	<!-- end::navigation-logo -->

	<div class="navigation-menu-group">

		@if($groups = SharedData::get('groups'))
		@foreach($groups as $group_data)
		<div class="{{ request()->segment(2) == $group_data->field_primary || request()->segment(1) == 'home' ? 'open' : '' }}" id="{{ $group_data->field_primary }}">
			<ul>
				@if($menus = $group_data->has_menu)
				@foreach($menus as $menu)
				@if($menu->field_type == MenuType::Internal)
				<li>
					<a href="{{ $menu->field_action }}">
						<span>{{ $menu->field_name }}</span>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::External)
				<li>
					<a target="_blank" href="{{ $menu->field_action }}">
						<span>{{ $menu->field_name }}</span>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::Devider)
				<li>
					<hr>
				</li>
				@elseif($menu->field_type == MenuType::Menu)
				@php
				$active = request()->segment(2) == $group_data->field_primary && request()->segment(3) == 'default' && request()->segment(4) == $menu->field_primary;
				@endphp
				<li>
					<a class="{{ $active ? 'active' : '' }}" href="{{ $menu->field_action ? route($menu->field_action) : '' }}">
						<span>{{ $menu->field_name }}</span>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::Group)
				@php
				$open = request()->segment(2) == $group_data->field_primary && request()->segment(3) == $menu->field_primary;
				@endphp
				<li class="{{ $open ? 'open' : '' }}">
					<a href="#">{{ $menu->field_name }}</a>
					@if($links = $menu->has_link)
					<ul>
						@foreach($links as $link)
						@php
						$active = $open && request()->segment(4) == $link->field_primary;
						@endphp
						<li>
							<a class="{{ $active ? 'active' : '' }}" href="{{ $link->field_url ? $link->field_url : route($link->field_action) }}">
								{{ $link->field_name }}
							</a>
						</li>
						@endforeach
					</ul>
					@endif
				</li>
				@endif
				@endforeach
				@endif
			</ul>
		</div>
		@endforeach
		@endif

	</div>
</div>
@endif