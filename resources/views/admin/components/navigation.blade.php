<nav class="navbar">
	<a href="#" class="sidebar-toggler">
	<i data-feather="menu"></i>
	</a>
	<div class="navbar-content">
		<!-- <form class="search-form">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i data-feather="search"></i>
					</div>
				</div>
				<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
			</div>
		</form> -->
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<?php 
					$current_language = mb_strtoupper(app()->getLocale());
					$current_country = "ru";
					$current_language_name = "Русский";
					if($current_language == "EN") {
						$current_country = "us";
						$current_language_name = "English";
				} 
				?>
				<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="flag-icon flag-icon-{{$current_country}} mt-1" title="{{$current_country}}"></i> <span class="font-weight-medium ml-1 mr-1 d-none d-md-inline-block">{{$current_language_name}}</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="languageDropdown">
					<a href="?language=en" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1">English</span></a>
					<a href="?language=ru" class="dropdown-item py-2"><i class="flag-icon flag-icon-ru" title="ru" id="ru"></i> <span class="ml-1">Русский</span></a>
				</div>
			</li>
			<li class="nav-item dropdown nav-notifications">
				<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i data-feather="bell"></i>
					<div class="indicator" style="display: block;">
						<div class="circle"></div>
					</div>
				</a>
				<div class="dropdown-menu" aria-labelledby="notificationDropdown">
					<div class="dropdown-header d-flex align-items-center justify-content-between">
						<p class="mb-0 font-weight-medium">6 New Notifications</p>
						<a href="javascript:;" class="text-muted">Clear all</a>
					</div>
					<div class="dropdown-body">
						<a href="javascript:;" class="dropdown-item">
							<div class="icon">
								<i data-feather="user-plus"></i>
							</div>
							<div class="content">
								<p>New customer registered</p>
								<p class="sub-text text-muted">2 sec ago</p>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item">
							<div class="icon">
								<i data-feather="gift"></i>
							</div>
							<div class="content">
								<p>New Order Recieved</p>
								<p class="sub-text text-muted">30 min ago</p>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item">
							<div class="icon">
								<i data-feather="alert-circle"></i>
							</div>
							<div class="content">
								<p>Server Limit Reached!</p>
								<p class="sub-text text-muted">1 hrs ago</p>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item">
							<div class="icon">
								<i data-feather="layers"></i>
							</div>
							<div class="content">
								<p>Apps are ready for update</p>
								<p class="sub-text text-muted">5 hrs ago</p>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item">
							<div class="icon">
								<i data-feather="download"></i>
							</div>
							<div class="content">
								<p>Download completed</p>
								<p class="sub-text text-muted">6 hrs ago</p>
							</div>
						</a>
					</div>
					<div class="dropdown-footer d-flex align-items-center justify-content-center">
						<a href="javascript:;">View all</a>
					</div>
				</div>
			</li>
			<li class="nav-item dropdown nav-profile">
				<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="https://via.placeholder.com/30x30" alt="profile">
				</a>
				<div class="dropdown-menu" aria-labelledby="profileDropdown">
					<div class="dropdown-header d-flex flex-column align-items-center">
						<div class="figure mb-3">
							<img src="https://via.placeholder.com/80x80" alt="">
						</div>
						<div class="info text-center">
							<p class="name font-weight-bold mb-0">{{auth()->user()->name}}</p>
							<p class="email text-muted mb-3">{{auth()->user()->email}}</p>
						</div>
					</div>
					<div class="dropdown-body">
						<ul class="profile-nav p-0 pt-3">
							<li class="nav-item">
								<a href="{{route("adminProfile")}}" class="nav-link">
									<i data-feather="user"></i>
									<span>{{__("menu.profile")}}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="javascript:;" class="nav-link">
									<i data-feather="log-out"></i>
									<span>{{__("menu.logout")}}</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>