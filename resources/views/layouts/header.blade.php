<header>
    <div class="top_info">
        <div class="container">
            <div class="top_info_content">
                <p><span class="red_text">График работы:</span> {{ $contact->date }}</p>
                <ul>
                    <li>
                        @if ($contact->phone)
                            <a href="tel: {{ $contact->phone }}"><img src="/dist/images/call.svg"
                                    alt="">{{ $contact->phone }}</a>
                        @else
                            <a href="tel: +7 (727) 326-99-26"><i class="fas fa-phone-alt"></i>+7 (727) 326-99-26</a>
                        @endif

                    </li>
                    <li>
                        @if ($socials->whats_app)
                            <a href="https://wa.me/{{ $socials->whats_app }}?text=Здраствуйте!" target="_blank"><i
                                    class="fab fa-whatsapp"></i>{{ $socials->whats_app }}</a>
                        @else
                            <a href="https://wa.me/+7 (701) 026-99-26?text=Здраствуйте!" target="_blank"><i
                                    class="fab fa-whatsapp"></i>+7 (701) 026-99-26</a>
                        @endif
                    </li>
                    <li>
                        <a href="mailto:secretary@abecorp.kz" target="blank"><img src="/dist/images/mail2.svg"
                                alt="">{{ $contact->email }}</a>
                    </li>
                </ul>
                <div class="info_data social">
                    <div class="favorites_link tablet_favorites">
                        <a href="/favorites">
                            <span class="favorites_count"></span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <a href="{{ $socials->instagram ?? '' }}" target="_blank" class="head_social_icon"><i
                            class="fab fa-instagram"></i></a>
                    <a href="{{ $socials->facebook ?? '' }}" target="_blank" class="head_social_icon"><i
                            class="fab fa-facebook-f"></i></a>
                    <button class="btn btn_red" data-toggle="modal" data-target="#modalTopForm">Заказать звонок</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="nav">
            <div class="logo">
                <a href="/"><img src="/dist/images/logo.svg" alt=""></a>
            </div>
            <div class="nav_content nav_desktop">
                <li><a href="/" class="@if (request()->path() == '/') active_link @endif">Главная</a></li>
                <li class="dropdown_toggle">
                    <a href="" class="dr_btn @if ((request()->route() != null &&
                        request()
                        ->route()
                        ->getName() == 'catalog_show') ||
                        (request()->route() != null &&
                        request()
                        ->route()
                        ->getName() == 'sub_catalog_show')) active_link @endif" >Каталог <img
                            src="/dist/images/chevron_down.svg" alt=""></a>
                    <div class="dropdown-menu">
                        @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="{{ url('/catalog/' . $category->slug) }}">{{ $category->title }}
                            </a>
                        @endforeach
                    </div>
                </li>
                <li>
                    <a href="/{{ $about->slug }}" class="@if (request()->path() ==
                        $about->slug) active_link @endif">{{ $about->title_name ?? 'О компании' }}</a>
                </li>
                <li>
                    <a href="/{{ $sales->slug }}" class="@if (request()->path() ==
                        $sales->slug) active_link @endif">{{ $sales->title_name ?? 'Акции' }}</a>
                </li>
                <li>
                    <a href="/{{ $brands->slug }}" class="@if (request()->path() ==
                        $brands->slug) active_link @endif">{{ $brands->title_name ?? 'Бренды' }}</a>
                </li>
                <li>
                    <a href="/{{ $services->slug }}" class="@if (request()->path() ==
                        $services->slug) active_link @endif">{{ $services->title_name ?? 'Услуги' }}</a>
                </li>
                <li>
                    <a href="/{{ $partners->slug }}" class="@if (request()->path() ==
                        $partners->slug) active_link @endif">{{ $partners->title_name ?? 'Партнерам' }}</a>
                </li>
                <li>
                    <a href="/contact" class="@if (request()->path() == 'contact') active_link @endif">Контакты</a>
                </li>

                <div class="search">
                    <li class="favorites_link">
                        <a href="/favorites">
                            <span class="favorites_count"></span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <span class="search_icon"><img src="/dist/images/search.svg" alt=""></span>
                    <div class="search_content">
                        <form action="/search" method="GET">
                            <button class="search_button"><img src="/dist/images/search.svg" alt=""></button>
                            <input type="text" placeholder="Поиск" class="search_product" name='text'>
                            <i class="fas fa-times exit_search"></i>
                        </form>
                        <div class="search_results">
                        </div>
                    </div>
                </div>
                <div class="search_content_tablet">
                    <form action="">
                        <img src="/dist/images/search.svg" alt="">
                        <input type="text" placeholder="Поиск" class="search_product">
                    </form>
                    <div class="search_results"></div>
                </div>
            </div>
            <div class="mobile_header">
                <li class="favorites_link">
                    <a href="/favorites">
                        <span class="favorites_count"></span>
                        <i class="fas fa-heart"></i>
                    </a>
                </li>
                <div class="search search_mobile_toggle">
                    <span class="search_icon"><img src="/dist/images/search.svg" alt=""></span>
                </div>
                <div class="burger_menu">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="tablet_back_call">
    <a href="#" data-toggle="modal" data-target="#modalTopForm"><img src="/dist/images/wp_call.svg" alt=""></a>
</div>
<div class="toTop" id="ToTop">
    <img src="/dist/images/top_btn.svg" alt="">
</div>
<div class="mobile_nav_menu">
    <span class="exit_menu">
        <i class="fas fa-times"></i>
    </span>
    <div class="mobile_nav_links">
        <ul>
            <li><a href="/">Главная</a></li>
            <li class="mobile_catalog"><a href="{{ url('/catalog') }}" class="@if ((request()->route() != null &&
                    request()
                    ->route()
                    ->getName() == 'catalog_show') ||
                    (request()->route() != null &&
                    request()
                    ->route()
                    ->getName() == 'sub_catalog_show')) active_link @endif">Каталог</a><img
                    src="/dist/images/chevron_down.svg" alt=""></li>
            <div class="catalog_links">
                @foreach ($categories as $category)
                    <a class="dropdown-item" href="{{ url('/catalog/' . $category->slug) }}">{{ $category->title }}
                    </a>
                @endforeach
            </div>
            <li>
                <a href="/{{ $about->slug }}" class="@if (request()->path() == $about->slug) active_link @endif">{{ $about->title_name ?? 'О компании' }}</a>
            </li>
            <li>
                <a href="/{{ $sales->slug }}" class="@if (request()->path() == $sales->slug) active_link @endif">{{ $sales->title_name ?? 'Акции' }}</a>
            </li>
            <li>
                <a href="/{{ $brands->slug }}" class="@if (request()->path() == $brands->slug) active_link @endif">{{ $brands->title_name ?? 'Бренды' }}</a>
            </li>
            <li>
                <a href="/{{ $services->slug }}" class="@if (request()->path() ==
                    $services->slug) active_link @endif">{{ $services->title_name ?? 'Услуги' }}</a>
            </li>
            <li>
                <a href="/{{ $partners->slug }}" class="@if (request()->path() ==
                    $partners->slug) active_link @endif">{{ $partners->title_name ?? 'Партнерам' }}</a>
            </li>
            <li>
                <a href="/contact" class="@if (request()->path() == 'contact') active_link @endif">Контакты</a>
            </li>

        </ul>

    </div>
    <div class="mobile_nav_footer">
        <p>Пн-Пт 09:00 - 18:00</p>
        <div class="mobile_nav_social social">
            <a href="{{ $socials->instagram ?? '' }}" target="_blank" class="head_social_icon"><i
                    class="fab fa-instagram"></i></a>
            <a href="{{ $socials->facebook ?? '' }}" target="_blank" class="head_social_icon"><i
                    class="fab fa-facebook-f"></i></a>
            <a href="mailto:secretary@abecorp.kz" target="blank" class="head_social_icon"><img
                    src="/dist/images/mail_silver.svg" alt=""></a>
        </div>
    </div>
</div>
<div class="mobile_search">
    <div class="search_content_mobile">
        <form action="">
            <input type="text" placeholder="Что вы ищите ?" class="search_product">
            <i class="fas fa-times exit_search"></i>
        </form>
    </div>
    <div class="search_results">
    </div>
</div>

<div class="modal fade" id="modalTopForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="requestTopCallForm">
                <div class="modal-body">
                    <label for="">Имя</label>
                    <input type="text" placeholder="Имя" name="name" class="name" autocomplete="off">
                    <span id="email" class="error_text"></span>
                    <label for="">Телефон</label>
                    <input placeholder="Введите номер телефона" name="phone" class="phone" autocomplete="off">
                    <span id="email" class="error_text"></span>
                    <label for="">Комментарии</label>
                    <textarea name="comment" id="" class="form-control coment"></textarea>
                    <span id="email" class="error_text mb-4"></span>

                    <div id="recaptcha1" class="g-recaptcha"></div>
                    <span class="error_text"></span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn_red" id="requestCallTopButton" data-type="top_order">Отправить
                        заявку</button>
                </div>
            </form>
        </div>
    </div>
</div>
