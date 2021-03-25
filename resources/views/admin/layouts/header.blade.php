<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"><h3></h3></div>
        <div class="lds-pos"><h1></h1></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md">
            <div class="navbar-header" data-logobg="skin6">
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <div class="navbar-brand">
                    <!-- Logo icon -->
                    <a href="{{url('/admin')}}">
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{asset('dist/images/logo.svg')}}" width="210" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                    </a>
                </div>
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                    <!-- Notification -->

                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="javascript:void(0)">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                    @guest

                    @else
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-2 d-none d-lg-inline-block"><span class="text-dark">Привет,</span> <span class="text-dark"> {{ Auth::user()->name }}</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                Выйти

                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        @endguest
                        </li>
                </ul>
            </div>
        </nav>

    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/admin')}}" aria-expanded="false"><i
                                data-feather="home" class="feather-icon"></i><span class="hide-menu">Главная </span></a></li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('/admin/orders')}}" aria-expanded="false"><i class="far fa-address-book"></i><span class="hide-menu">Заявки </span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('category.index')}}" aria-expanded="false"><i class="fas fa-bars"></i><span class="hide-menu">Категории</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('criterion.index')}}" aria-expanded="false"><i class="fas fa-adjust"></i><span class="hide-menu">Все бренды</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('filters.index')}}" aria-expanded="false"><i class="fas fa-filter"></i><span class="hide-menu">Фильтры</span></a></li>
                    <li class="list-divider"></li>

                    <li class="sidebar-item">
                        <a href="{{url('/admin/slider')}}" class="sidebar-link">
                            <i class="fas fa-piggy-bank"></i>
                            <span class="hide-menu"> Слайдер акции</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item">
                        <a href="{{url('/admin/banner')}}" class="sidebar-link">

                            <i class="fas fa-piggy-bank"></i>
                            <span class="hide-menu"> Рекламный баннер</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="{{route('about.index')}}" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                class="hide-menu">Страницы </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            {{-- <li class="sidebar-item">
                                <a href="{{url('/admin/about/main-page')}}" class="sidebar-link">
                                    <i class="fas fa-home"></i>
                                    <span class="hide-menu"> Главная страница</span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item"><a href="{{route('about.index')}}" class="sidebar-link">
                                <i class="fas fa-building"></i>
                                <span class="hide-menu">О Компании</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{url('/admin/sale')}}" class="sidebar-link">
                                    <i class="fas fa-percent"></i>
                                    <span class="hide-menu"> Акции</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{url('/admin/brands')}}" class="sidebar-link">
                                    <i class="fas fa-tag"></i>
                                    <span class="hide-menu"> Бренды</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{url('/admin/service_page')}}" class="sidebar-link">
                                    <i class="fas fa-list"></i>
                                    <span class="hide-menu"> Услуги</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{url('/admin/partners_page')}}" class="sidebar-link">
                                    <i class="fas fa-handshake"></i>
                                    <span class="hide-menu"> Партнерам</span>
                                </a>
                            </li>

                            {{-- <li class="sidebar-item"><a href="{{route('blog.index')}}" class="sidebar-link"><i class="fas fa-question-circle"></i><span
                                        class="hide-menu"> Информационные <br>страницы
                                        </span></a>
                            </li> --}}
                            <!-- <li class="sidebar-item"><a href="{{route('service.index')}}" class="sidebar-link"><i class="fab fa-servicestack"></i><span
                                        class="hide-menu"> Блок услуги
                                        </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{route('slider.index')}}" class="sidebar-link"><i class="fas fa-sliders-h"></i><span
                                        class="hide-menu"> Слайдер Гл.Стр
                                        </span></a>
                            </li>

                            <li class="sidebar-item"><a href="{{route('description.index')}}" class="sidebar-link"><i class="fas fa-arrow-down"></i><span
                                        class="hide-menu">Блок партнерам
                                        </span></a>
                            </li> -->
                            <li class="sidebar-item"><a href="{{route('info.index')}}" class="sidebar-link"><i class="far fa-address-book"></i><span
                                        class="hide-comment">Контакты
                                        </span></a>
                            </li>

                        </ul>
                    <li class="list-divider"></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('product.index')}}" aria-expanded="false"><i class="fas fa-shopping-cart"></i><span class="hide-menu">Товары</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('review.index')}}" aria-expanded="false"><i class="fas fa-file-pdf"></i><span class="hide-menu">Отзывы</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>

                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{route('user.index')}}" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu">Пользователи</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"></span></li>



                </ul>

            </nav>
        </div>
    </aside>
</div>


