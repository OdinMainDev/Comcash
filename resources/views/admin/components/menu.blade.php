<nav class="sidebar">
	<div class="sidebar-header">
		<a href="#" class="sidebar-brand">
		Control<span>Panel</span>
		</a>
		<div class="sidebar-toggler not-active">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="sidebar-body">
		<ul class="nav">
			<li class="nav-item">
				<a href="{{route("adminDashboard")}}" class="nav-link">
					<i class="link-icon" data-feather="box"></i>
					<span class="link-title">{{__("menu.home")}}</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route("index")}}" class="nav-link">
					<i class="link-icon" data-feather="arrow-up-right"></i>
					<span class="link-title">{{__("menu.return_to_site")}}</span>
				</a>
			</li>
			@can("handle-currencies")
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#currenciessidemenu" role="button" aria-expanded="false" aria-controls="currenciessidemenu">
				<i class="link-icon" data-feather="dollar-sign"></i>
					<span class="link-title">{{__("menu.currencies")}}</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				</a>
				<div class="collapse" id="currenciessidemenu">
					<ul class="nav sub-menu">
						<li class="nav-item">
							<a href="{{route("adminCurrencyList")}}" class="nav-link">{{__("menu.list")}}</a>
						</li>
						<li class="nav-item">
							<a href="{{route("adminCurrencyAdd")}}" class="nav-link">{{__("menu.add")}}</a>
						</li>
					</ul>
				</div>
			</li>
			@endcan
			@can("handle-merchants")
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#merchantssidemenu" role="button" aria-expanded="false" aria-controls="merchantssidemenu">
					<i class="link-icon" data-feather="monitor"></i>
						<span class="link-title">{{__("menu.merchants")}}</span>
						<i class="link-arrow" data-feather="chevron-down"></i>
					</a>
					<div class="collapse" id="merchantssidemenu">
						<ul class="nav sub-menu">
							<li class="nav-item">
								<a href="{{route("adminMerchantList")}}" class="nav-link">{{__("menu.list")}}</a>
							</li>
							<li class="nav-item">
								<a href="{{route("adminMerchantAdd")}}" class="nav-link">{{__("menu.add")}}</a>
							</li>
						</ul>
					</div>
				</li>
			@endcan
			@can("handle-directions")
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#directionssidemenu" role="button" aria-expanded="false" aria-controls="directionssidemenu">
					<i class="link-icon" data-feather="monitor"></i>
						<span class="link-title">{{__("menu.directions")}}</span>
						<i class="link-arrow" data-feather="chevron-down"></i>
					</a>
					<div class="collapse" id="directionssidemenu">
						<ul class="nav sub-menu">
							<li class="nav-item">
								<a href="{{route("adminMerchantList")}}" class="nav-link">{{__("menu.list")}}</a>
							</li>
							<li class="nav-item">
								<a href="{{route("adminDirectionAdd")}}" class="nav-link">{{__("menu.add")}}</a>
							</li>
						</ul>
					</div>
				</li>
			@endcan
			@can("handle-roles")
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#rolessidemenu" role="button" aria-expanded="false" aria-controls="rolessidemenu">
					<i class="link-icon" data-feather="alert-octagon"></i>
						<span class="link-title">{{__("menu.roles")}}</span>
						<i class="link-arrow" data-feather="chevron-down"></i>
					</a>
					<div class="collapse" id="rolessidemenu">
						<ul class="nav sub-menu">
							<li class="nav-item">
								<a href="{{route("adminRoleList")}}" class="nav-link">{{__("menu.list")}}</a>
							</li>
							<li class="nav-item">
								<a href="{{route("adminRoleAdd")}}" class="nav-link">{{__("menu.add")}}</a>
							</li>
						</ul>
					</div>
				</li>
			@endcan
			@can("handle-languages")
				<li class="nav-item">
					<a class="nav-link" href="{{route("languages.index")}}">
						<i class="link-icon" data-feather="flag"></i>
						<span class="link-title">{{__("menu.languages")}}</span>
					</a>
				</li>
			@endcan
		</ul>
	</div>
</nav>