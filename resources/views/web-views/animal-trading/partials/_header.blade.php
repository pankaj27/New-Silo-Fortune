<header class="header">
				<div class="container">
					<nav class="navbar navbar-expand-lg header-nav">
						<div class="navbar-header">
							<a id="mobile_btn" href="javascript:void(0);"> <span class="bar-icon"> <span></span> <span></span> <span></span> </span> </a>
							<a href="{{route('home')}}" class="navbar-brand logo"> <img style="height: 38px!important;width:auto;" src="{{asset("storage/app/public/company")."/".$web_config['web_logo']->value}}" class="img-fluid" alt="Logo"> </a>
						</div>
						<div class="main-menu-wrapper">
							<div class="menu-header">
								<a href="{{route('home')}}" class="menu-logo"> <img style="height: 40px!important; width:auto;" src="{{asset("storage/app/public/company")."/".$web_config['web_logo']->value}}" class="img-fluid" alt="Logo"> </a>
								<a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
							</div>
							<ul class="main-nav">
								<li>
									<a href="{{route('home')}}">Home</a>
									
								</li>
								
								<li class="{{Request::is('animal-trading')?'active':''}}">
									<a href="{{route('animal-trading')}}">Animal Trading</a>
									
								</li>
								<li class="{{Request::is('view-all-category')?'active':''}}">
									<a href="{{route('view-all-category')}}">Our Catogory</a>
									
								</li>
								
								<li class="{{Request::is('animal-trading/view-all-ads')?'active':''}}">
									<a href="{{route('view-all-ads')}}">Latest Ad</a>
									
								</li>
								
								<li class="has-submenu">
									<a href="#">Ask any Ouestion ?</a>
									
								</li>
								@if(auth('customer')->check())
								    <li class="login-link">
								        <a class="nav-link header-login add-listing" href="{{route('add-product')}}"><i class="fa-solid fa-plus"></i> Add Listing</a>
								    </li>
								
								    <li class="login-link"><a href="{{route('account-oder')}}">{{ \App\CPU\translate('my_order')}}</a></li>
								    <li class="login-link"><a href="{{route('user-account')}}">{{ \App\CPU\translate('my_profile')}}</a></li>
                                    <li class="login-link"><a href="{{route('customer.auth.logout')}}">{{ \App\CPU\translate('logout')}}</a></li>
								    
    							
								
								@else
								
								
								
								<li class="login-link">
									<a href="{{route('customer.auth.sign-up')}}">Sign Up</a>
								</li>
								<li class="login-link">
									<a href="{{route('customer.auth.login')}}">Sign In</a>
								</li>
								
								@endif
							</ul>
						</div>
						
						    @if(auth('customer')->check())
    						
    						    <ul class="nav header-navbar-rht">
                                    <li class="nav-item">
                                        <a class="nav-link header-login add-listing" href="{{route('add-product')}}"><i class="fa-solid fa-plus"></i> Add Listing</a>
                                    </li>
                                    <li class="nav-item dropdown has-arrow logged-item">
                                        <a href="#" class="dropdown-toggle profile-userlink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('storage/app/public/profile/'.auth('customer')->user()->image)}}" onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" alt>
                                                <span>{{\App\CPU\translate('hello')}}, {{auth('customer')->user()->f_name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{route('account-oder')}}">{{ \App\CPU\translate('my_order')}}</a>
                                            <a class="dropdown-item" href="{{route('user-account')}}">{{ \App\CPU\translate('my_profile')}}</a>
                                            <a class="dropdown-item" href="{{route('customer.auth.logout')}}">{{ \App\CPU\translate('logout')}}</a>
                                        </div>
                                    </li>
                                </ul>
    						
							 @else
    							  <ul class="nav header-navbar-rht">
    							        <li class="nav-item">
                                            <a class="nav-link header-login add-listing" href="#" onclick="return confirm('Please Login or Signup to upload your First Product')"><i class="fa-solid fa-plus"></i> Add Listing</a>
                                        </li>
        							    <li class="nav-item">
            								<a class="nav-link header-reg" href="{{route('customer.auth.sign-up')}}">Sign Up</a>
            							</li>
            							<li class="nav-item">
            								<a class="nav-link header-login" href="{{route('customer.auth.login')}}"> Sign In</a>
            							</li>
            							
        						   </ul>
    						@endif
					
					</nav>
				</div>
			</header>