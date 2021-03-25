@extends('layouts.app')

@if (isset($products->meta_title))
    @section('title', $products->meta_title)
@else
    @section('title', $products->name . ' - Timberstone')
@endif

@section('meta_description', $products->meta_description ?? '')

@section('content')
    @include('admin.components.message')
    <div class="catalog_innder_page">
        <div class="container">

            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{ url('/') }}">Главная</a></li>
                    @if (isset($products->getCatalog->parent->id))
                        <li>
                            <a
                                href="/catalog/{{ $products->getCatalog->parent->slug }}">{{ $products->getCatalog->parent->title }}</a>
                        </li>
                        <li><a
                                href="/catalog/{{ $products->getCatalog->parent->slug }}/{{ $products->getCatalog->slug }}">{{ $products->getCatalog->title }}</a>
                        </li>
                    @else
                        <li><a href="/catalog/{{ $products->getCatalog->slug }}">{{ $products->getCatalog->title }}</a>
                        </li>
                    @endif
                    <li>{{ $products->name }}</li>
                </ul>
                {{-- {{dd($products->getCatalog->id,$products->getCatalog->parent->id)}} --}}
            </div>
            <div class="product_info_main" data-id="{{ $products->id }}">
                <div class="row">
                    <div class="col-xl-4 col-lg-6">



                        <div class="product_info_main_slider">
                            {{-- <span class="like">
                            <i class="far fa-heart" id="{{ $products->id }}"></i>
                           </span> --}}
                            <span class="like">
                                <i class="far fa-heart like_icon" id="{{ $products->id }}"></i>
                            </span>
                            <div class="slider_for_wrapper">
                                @if($products->sale == 1)
                                    <span class="percent">
                                        <img src="{{ asset('/dist/images/percent.svg') }}" alt="">
                                    </span>
                                @endif
                                <div class="slider-for">
                                    @if($products->childrenImg != NULL && $products->childrenImg->count() > 0)
                                        @foreach ($products->childrenImg as $image)
                                            <div>
                                                <img src="/storage/test/{{ $image->image }}" alt="image" class="main_img">
                                            </div>
                                        @endforeach
                                    @else
                                        <div>
                                            <img src="/dist/images/image-not-found.svg" alt="image" class="main_img">
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if (isset($products->childrenImg) && $products->childrenImg->count() > 1)
                                <div class="slider-nav">
                                    @foreach ($products->childrenImg as $image)
                                        <div>
                                            <img src="/storage/test/{{ $image->image }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6">
                        <div class="product_info_main_text">
                            <div class="title_page_block">
                                <p>{{ $products->name }}</p>
                            </div>
                            <div class="product_main_info">
                                <div class="review_star mb-2 review_star_modal">
                                    <a href="#" data-toggle="modal" data-target="#product_review">
                                        <select class="add_rating">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </a>
                                </div>
                                @if (isset($products->price))
                                    <p class="price">Цена: <span class="red_text">{{ $products->price }} <img
                                                src="/dist/images/tg.svg" alt=""></span></p>
                                @endif
                                <p><b>Артикул:</b> {{ $products->article }}</p>
                                <p><b>Бренд:</b>
                                    @foreach ($products->brands as $item)
                                        <a href="{{ url('/brands/' . $item->slug) }}"
                                            class="brand_a"><span>{{ $item->name }}</span></a>
                                    @endforeach
                                </p>
                            </div>

                            <div class="product_specifications_info ">
                                <ul>
                                    @if (isset($products->feature))
                                        @foreach ($products->feature as $item)
                                            <li>
                                                <b>{{ $item->title }}: </b>
                                                <span>
                                                    {{ $item->title_name }}
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                    @if (isset($products->countries))
                                        <li>
                                            <b>Страна производства: </b>
                                            <span>{{ $products->countries->name }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="product_specifications">
                                <div class="specifications_wrapper">
                                    @foreach ($feature as $item)
                                        <span class="specification" data-toggle="tooltip" data-placement="right"
                                            title="{{ $item->title_name }}">
                                            <img src="/storage/{{ $item->icon }}" alt="">
                                        </span>
                                    @endforeach
                                </div>
                                <div class="socials">
                                    <script src="https://yastatic.net/share2/share.js"></script>
                                    <div class="ya-share2" data-curtain data-size="l" data-shape="round" data-services="facebook,whatsapp" @if($products->childrenImg != null && $products->childrenImg->count() > 0) data-image="/storage/test/{{ $products->childrenImg[0]->image }}" @endif></div>
                                </div>

                            </div>
                            {{-- <button type="submit" class="btn btn_dotted like_icon" id="{{ $products->id }}"> В избранное</button> --}}
                            <br>
                            <div class="send_call">
                                <a href="https://wa.me/877013269926?text=Здраствуйте! {{ url()->full() }}"
                                    target="_blank"><button class="btn btn_red">
                                        <i class="fab fa-whatsapp"></i>WhatsApp
                                    </button></a>
                                <button class="btn btn_outline" data-toggle="modal" data-target="#product_modal"
                                    data-type="product_order">
                                    <img src="/dist/images/call.svg" alt=""> Заказать звонок
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_info_tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Описание</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Характеристики</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Отзывы</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="title_page_block">
                            <p>{{ $products->name }}</p>
                        </div>
                        <div class="tab_text">
                            <p>
                                {!! $products->description !!}
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="product_specifications_info">
                            <ul>
                                @foreach ($products->feature as $item)
                                    <li>
                                        <b>{{ $item->title }}: </b>
                                        <span>
                                            {{ $item->title_name }}
                                        </span>

                                @endforeach
                                @if (isset($countries))
                                    <li>
                                        <p>Страна производства: </p>
                                        <span>{{ $products->countries->name }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="review">
                            @forelse ($products->review as $item)
                                @if ($item->status == 1)
                                    <div class="review_content">
                                        <div class="review_user">
                                            @if (isset($item->image))
                                                <img src="/storage/{{ $item->image }}" alt="">
                                            @else
                                                <div class="user_avatar">
                                                    <p>{{ $item->name }}</p>
                                                    <p>{{ $item->last_name }}</p>
                                                </div>
                                            @endif
                                            <div class="review_user_name">
                                                <div class="user_name">
                                                    <p>{{ $item->name }}</p>
                                                    <p>{{ $item->last_name }}</p>
                                                </div>
                                                <span
                                                    class="silver_text">{{ Date::parse($item->created_at)->format('j F в H:m') }}</span>
                                            </div>
                                        </div>
                                        <div class="review_star star_color">
                                            {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', $item->rating) !!}
                                            {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true"></i>', 5 - $item->rating) !!}
                                        </div>
                                        <div class="review_text">
                                            <p>{{ $item->review }}</p>
                                        </div>
                                    </div>
                                @endif
                                @empty
                                <p>Отзывов нет!</p>
                            @endforelse
                                <form id="requestReviewFormTab">
                                    <div class="modal-body p-0 row">
                                        <div class="col-xl-6">
                                            <label for="">Имя</label>
                                            <input type="text" placeholder="Имя" name="name" class="name" autocomplete="off">
                                            <span id="name" class="error_text"></span>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="">Фамилия</label>
                                            <input type="text" placeholder="Фамилия" name="last_name" class="last_name" autocomplete="off">
                                            <span id="last_name" class="error_text"></span>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="">E-mail</label>
                                            <input type="email" placeholder="E-mail" name="email" class="emailCall" autocomplete="off">
                                            <span id="email" class="error_text"></span>
                                        </div>
                                        <div class="col-xl-6">
                                             <label for="">Поставьте оценку</label>
                                             <div class="review_star">
                                                <select class="add_rating">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <span id="rating" class="error_text"></span>
                                        </div>
                                       <div class="col-xl-6">
                                            <label for="">Отзыв</label>
                                            <textarea name="review" id="" class="form-control coment"></textarea>
                                            <span id="email" class="error_text"></span>
                                       </div>
                                        <div class="col-xl-6">
                                            <label for="" class="mb-5"></label>
                                            <div class="g-recaptcha" id="recaptcha2"></div>
                                            <span class="error_text"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3">
                                        <button class="btn btn_red send_review" id="send_review_tab">Отправить отзыв</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product_info_slider_wrapper">
                <div class="title_block">
                    <h3>Недавно вы смотрели</h3>
                </div>
                <div class="product_watch products_wrapper row">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="requestCallForm">
                    <div class="modal-body">
                        <label for="">Имя</label>
                        <input type="text" placeholder="Имя" name="name" class="name" autofocus maxlength="20" autocomplete="off">
                        <span id="name" class="error_text"></span>
                        <label for="">Телефон</label>
                        <input placeholder="Введите номер телефона" name="phone" class="phone" autocomplete="off">
                        <span id="phone" class="error_text"></span>
                        <label for="">E-mail</label>
                        <input type="email" placeholder="E-mail" name="email" class="emailCall" maxlength="30" autocomplete="off">
                        <span id="email" class="error_text"></span>
                        <span id="valid"></span>
                        <label for="">Комментарии</label>
                        <textarea name="comment" id="" class="form-control coment"></textarea>
                        <span id="comment" class="error_text mb-3"></span>
                        <div class="g-recaptcha" id="recaptcha3"></div>
                        <span class="error_text"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn_red" id="requestCallFormButton"
                            data-type="product_order">Отправить заявку</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="product_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Отправить отзыв</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="requestReviewForm">
                    <div class="modal-body ">
                        <label for="">Имя</label>
                        <input type="text" placeholder="Имя" name="name" class="name" autocomplete="off">
                        <span id="name" class="error_text"></span>
                        <label for="">Фамилия</label>
                        <input type="text" placeholder="Фамилия" name="last_name" class="last_name" autocomplete="off">
                        <span id="last_name" class="error_text"></span>
                        <label for="">E-mail</label>
                        <input type="email" placeholder="E-mail" name="email" class="emailCall" autocomplete="off">
                        <span id="email" class="error_text"></span>
                        <label for="">Отзыв</label>
                        <textarea name="review" id="" class="form-control coment"></textarea>
                        <span id="email" class="error_text"></span>

                        <label for="">Поставьте оценку</label>
                        <div class="review_star">
                            <select class="add_rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <span id="rating" class="error_text"></span>
                        <br>
                        <div class="g-recaptcha" id='recaptcha4'></div>
                        <span class="error_text"></span>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn_red" id="send_review">Отправить отзыв</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
