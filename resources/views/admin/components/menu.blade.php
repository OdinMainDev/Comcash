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
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#currenciessidemenu" role="button" aria-expanded="false" aria-controls="currenciessidemenu">
				<i class="link-icon" data-feather="dollar-sign"></i>
					<span class="link-title">{{__("menu.currencies")}}</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				</a>
				<div class="collapse" id="currenciessidemenu">
					<ul class="nav sub-menu">
						<li class="nav-item">
							<a href="pages/email/inbox.html" class="nav-link">{{__("menu.list")}}</a>
						</li>
						<li class="nav-item">
							<a href="pages/email/read.html" class="nav-link">{{__("menu.add")}}</a>
						</li>
					</ul>
				</div>
			</li>
			
		</ul>
	</div>
</nav>