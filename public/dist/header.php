<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href=https://pro.fontawesome.com/releases/v5.10.0/css/all.css
        integrity=sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p crossorigin=anonymous>
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="top_info">
            <div class="container">
                <div class="top_info_content">
                    <ul>
                        <p><span class="red_text">График работы:</span> Пн-Пт 09:00 - 18:00</p>
                        <li>
                            <a href="tel: +7 (727) 326-99-26"><i class="fas fa-phone-alt"></i>+7 (727) 326-99-26</a>
                        </li>
                        <li>
                            <a href="tel: +7 (701) 326-99-26"><i class="fab fa-whatsapp"></i>+7 (701) 326-99-26</a>
                        </li>
                        <li>
                            <a href="secretary@abecorp.kz"><img src="./images/mail.svg" alt=""> secretary@abecorp.kz</a>
                        </li>
                    </ul>
                    <div class="info_data social">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <button class="btn btn_red">Заказать звонок</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <div class="logo">
                    <img src="./images/logo.svg" alt="">
                </div>
                <div class="nav_content nav_desktop">
                    <li><a href="#">Главная</a></li>
                    <li>
                        <a href="#" class="dropdown_toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Каталог <img src="./images/chevron_down.svg"
                                alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="google.com">Нанопаркет</a>
                            <a class="dropdown-item" href="#">Ламинат</a>
                            <a class="dropdown-item" href="#">Паркет</a>
                            <a class="dropdown-item" href="#">Винил</a>
                        </div>
                    </li>
                    <li> <a href="#">О компании</a></li>
                    <li> <a href="#">Акции</a></li>
                    <li> <a href="#">Бренды</a></li>
                    <li> <a href="#">Дизайнерам</a></li>
                    <li> <a href="#">Партнерам</a></li>
                    <li> <a href="#">Контакты</a></li>
                    <div class="search">
                        <span class="search_icon"><img src="./images/search.svg" alt=""></span>
                        <div class="search_content">
                            <form action="">
                                <img src="./images/search.svg" alt="">
                                <input type="text" placeholder="Поиск">
                                <i class="fas fa-times exit_search"></i>
                            </form>
                        </div>
                    </div>
                    <div class="search_content_tablet">
                        <form action="">
                            <img src="./images/search.svg" alt="">
                            <input type="text" placeholder="Поиск">
                        </form>
                    </div>
                </div>
                <div class="mobile_header">
                    <div class="search search_mobile_toggle">
                        <span class="search_icon"><img src="./images/search.svg" alt=""></span>
                    </div>
                    <div class="burger_menu">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile_nav_menu">
        <span class="exit_menu">
            <i class="fas fa-times"></i>
        </span>
        <div class="mobile_nav_links">
            <ul>
                <li><a href="#">Главная</a></li>
                <li><a href="#">Каталог</a></li>
                <li><a href="#">О компании</a></li>
                <li><a href="#">Акции</a></li>
                <li><a href="#">Бренды</a></li>
                <li><a href="#">Дизайнерам</a></li>
                <li><a href="#">Партнерам</a></li>
                <li><a href="#">Контакты</a></li>
                <li>
                    <button class="btn btn_red">Заказать звонок</button>
                </li>
            </ul>

        </div>
        <div class="mobile_nav_footer">
            <p>Пн-Пт 09:00 - 18:00</p>
            <div class="mobile_nav_social social">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><img src="./images/mail_silver.svg" alt=""></a>
            </div>
        </div>
    </div>
    <div class="mobile_search">
        <div class="search_content_mobile">
            <form action="">
                <input type="text" placeholder="Что вы ищите ?">
                <i class="fas fa-times exit_search"></i>
            </form>
        </div>
    </div>
