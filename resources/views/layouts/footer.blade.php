<footer>
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-4 m_order_4">
                <div class="footer_first_info">
                    <div class="logo desktop_block">
                        <a href="/">
                            <img src="/dist/images/logo.svg" alt="">
                        </a>
                    </div>
                    <p>TimberStone. © {{ date('Y') }}</p>
                    <p>Разработка сайта от <a href="https://studionomad.kz/" target="_blank" class="new_review">Studio Nomad</a></p>
                </div>
                <div class="map_footer mobile_block">
                    <a class="dg-widget-link" href="http://2gis.kz/almaty/profiles/70000001032219199,70000001043857684/center/76.87150955200197,43.22156500870522/zoom/13?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Алматы</a><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":'100%',"height":'100%',"borderColor":"#a3a3a3","pos":{"lat":43.22156500870522,"lon":76.87150955200197,"zoom":13},"opt":{"city":"almaty"},"org":[{"id":"70000001032219199"},{"id":"70000001043857684"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
                    </div>
            </div>
            <div class="col-xl-2 col-lg-4 footer_links m_order_2">
                <div class="title_footer_category">
                    <p class="bold_text">Информация</p>
                </div>
                <ul>
                    <li>
                        <a href="/"><i class="fas fa-chevron-right"></i> Главная </a>
                        </li>
                    <li>
                        <a href="{{url($about->slug)}}"><i class="fas fa-chevron-right"></i> {{$about->title_name}}</a>

                    </li>
                    <li>
                        <a href="{{url($sales->slug)}}"><i class="fas fa-chevron-right"></i> {{$sales->title_name}} </a>
                    </li>
                    <li>
                        <a href="{{url($brands->slug)}}"><i class="fas fa-chevron-right"></i> {{$brands->title_name}} </a>
                    </li>
                    <li>
                        <a href="{{url($services->slug)}}"><i class="fas fa-chevron-right"></i> {{$services->title_name}} </a>
                    </li>
                    <li>
                        <a href="{{url($partners->slug)}}"><i class="fas fa-chevron-right"></i> {{$partners->title_name}}</a>

                    </li>

                    <li>
                        <a href="{{url('contact')}}"><i class="fas fa-chevron-right"></i> {{'Контакты'}}</a>
                    </li>
                </ul>
                <div class="footer_contacts mobile_block">
                    <div class="title_footer_category">
                        <p class="bold_text">Контакты</p>
                    </div>
                    <ul>
                        <li>
                            @if($contact->phone)
                            <a href="tel: {{$contact->phone}}"><i class="fas fa-phone-alt"></i> {{$contact->phone}}</a>
                            @else
                                <a href="tel: +7 (727) 326-99-26"><i class="fas fa-phone-alt"></i> +7 (727) 326-99-26</a>
                                @endif
                        </li>
                        <li>
                            <a href="tel: {{$socials->whats_app}}"><img src="/dist/images/call_icon.svg" alt=""> {{$socials->whats_app}}</a>
                        </li>
                        <li>
                            <a href="#"><img src="/dist/images/loc_black.svg" alt=""> {{$contact->location}} </a>
                        </li>
                        <li>
                            <a href="mailto:{{$contact->email}}"><img src="/dist/images/mail_black.svg" alt=""> {{$contact->email}}</a>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 footer_links m_order_3">
                <div class="title_footer_category">
                    <p class="bold_text">Продукция</p>
                </div>
                <ul>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{url('/catalog/'.$category->slug)}}"><i class="fas fa-chevron-right"></i>{{$category->title}}</a>
                    </li>
                    @endforeach
                </ul>

            </div>
            {{-- <div class="col-xl-3 footer_contacts">
                <div class="title_footer_category">
                    <p class="bold_text">Контакты</p>
                </div>
                <ul>
                    <li>
                        @if($contact->phone)
                        <a href="tel: {{$contact->phone}}"><img src="/dist/images/call_black.svg" alt=""> {{$contact->phone}}</a>
                        @else
                            <a href="tel: +7 (727) 326-99-26"><img src="/dist/images/call_black.svg" alt=""> +7 (727) 326-99-26</a>
                            @endif
                    </li>
                    <li>
                        <a href="tel: {{$socials->whats_app}}"><img src="/dist/images/call_icon.svg" alt=""> {{$socials->whats_app}}</a>
                    </li>
                    <li>
                        <a href="#"><img src="/dist/images/loc_black.svg" alt=""> {{$contact->location}} </a>
                    </li>
                    <li>
                        <a href="mailto:{{$contact->email}}"><img src="/dist/images/mail_black.svg" alt=""> {{$contact->email}}</a>

                    </li>
                </ul>
            </div> --}}
            <div class="col-xl-3 col-lg-6">
                 <div class="footer_contacts mobile_none">
                    <div class="title_footer_category">
                        <p class="bold_text">Контакты</p>
                    </div>
                    <ul>
                        <li>
                            @if($contact->phone)
                            <a href="tel: {{$contact->phone}}"><i class="fas fa-phone-alt"></i> {{$contact->phone}}</a>
                            @else
                                <a href="tel: +7 (727) 326-99-26"><i class="fas fa-phone-alt"></i> +7 (727) 326-99-26</a>
                                @endif
                        </li>
                        <li>
                            <a href="tel: {{$socials->whats_app}}"><img src="/dist/images/call_icon.svg" alt=""> {{$socials->whats_app}}</a>
                        </li>
                        <li>
                            <a href="#"><img src="/dist/images/loc_black.svg" alt=""> {{$contact->location}} </a>
                        </li>
                        <li>
                            <a href="mailto:{{$contact->email}}"><img src="/dist/images/mail_black.svg" alt=""> {{$contact->email}}</a>

                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 pl-0 m_order_1">
                <div class="logo mobile_block">
                    <a href="/">
                        <img src="/dist/images/logo.svg" alt="">
                    </a>
                </div>
                 <div class="map_footer">
                    <a class="dg-widget-link" href="http://2gis.kz/almaty/profiles/70000001032219199,70000001043857684/center/76.87150955200197,43.22156500870522/zoom/13?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Алматы</a><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":'100%',"height":'100%',"borderColor":"#a3a3a3","pos":{"lat":43.22156500870522,"lon":76.87150955200197,"zoom":12},"opt":{"city":"almaty"},"org":[{"id":"70000001032219199"},{"id":"70000001043857684"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
                    </div>
            </div>
        </div>
    </div>
</footer>
