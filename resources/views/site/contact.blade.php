@extends('layouts.app')

@if (isset($blog_info->meta_title))
    @section('title', $blog_info->meta_title)
@else
    @section('title', 'Контакты - Timberstone')
@endif

@section('meta_description', $blog_info->meta_description ?? '')

@section('content')
    <div class="blogs">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{url('/')}}">{{'Главная'}}</a></li>
                    <li>{{ 'Контакты'}}</li>
                </ul>
            </div>
            <div class="blog_content_wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="blogs_links mobile_blogs_links">
                            <ul>
                                <ul>
                                    @foreach($blogs as $item)
                                        <li>
                                            <a href="{{url($item->slug)}}" class="@if(request()->path() == $item->slug) active_category @endif"><img src="/storage/{{$item->icon ?? ''}}">{{$item->title_name ?? ''}}</a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{url('contact')}}" class="@if(request()->path() == 'contact') active_category @endif"> <img src="/dist/images/icon/contacts.svg" > Контакты</a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                        @if(isset($advertising_banner))
                            <a href="{{url($advertising_banner->url)}}" class="advertising_banner">
                                <img src="/storage/{{ $advertising_banner->image }}" alt="">
                            </a>
                        @endif
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="blog_content contacts">
                           <div class="row">
                            <div class="col-xl-6">
                                <div class="title_block">
                                    <h1>Контакты</h1>
                                    @foreach($contacts as $item)
                                        <div class="contact_info mt-5">
                                            <label class="text-">Номер</label>
                                            <p>{{ $item->phone }}</p>
                                        </div>

                                        <div class="contact_info">
                                            <label class="text-">Почта:</label>
                                            <p>{{ $item->email }}</p>
                                        </div>

                                        <div class="contact_info">
                                            <label class="text-">Адрес:</label>
                                            <p>{{ $item->location }}</p>
                                        </div>

                                        <div class="contact_info">
                                            <label class="text-">График работы:</label>
                                            <p>{{ $item->date }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="map">
                                    <a class="dg-widget-link" href="http://2gis.kz/almaty/profiles/70000001032219199,70000001043857684/center/76.87150955200197,43.22156500870522/zoom/13?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Алматы</a><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":'100%',"height":'100%',"borderColor":"#a3a3a3","pos":{"lat":43.22156500870522,"lon":76.87150955200197,"zoom":13},"opt":{"city":"almaty"},"org":[{"id":"70000001032219199"},{"id":"70000001043857684"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
                                </div>
                            </div>
                           </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





@endsection
