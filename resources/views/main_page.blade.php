<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/main_page.css">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>

        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>	
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav-bar mb-4" aria-label="Eighth navbar example">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('main_page') }}">Главная страница</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-bs-toggle="dropdown"
                            aria-expanded="false">Маршруты</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown07">
                            <li><a class="dropdown-item" href="{{ route('routes.index') }}">Просмотр маршрутов</a></li>
                            @auth
                                <li><a class="dropdown-item" href="{{ route('routes.admin') }}">Редактирование маршрутов</a></li>
                            @endauth
                        </ul>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('calendar.index') }}">Расписание</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-bs-toggle="dropdown"
                            aria-expanded="false">Отчеты</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown07">
                            <li><a class="dropdown-item" href="{{ route('reports.create') }}">Добавление отчета</a></li>
                            <li><a class="dropdown-item" href="{{ route('reports.index') }}">Просмотр списка отчетов</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('bids.index') }}">Заявки</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
	
    @if(session('success'))
        <div class="alert alert-success d-flex alert-dismissible fade show alert-file" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#check-circle-fill"/></svg>
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif
	
	<div class="container main">

	<h2>Экскурсии в Крыму</h2>
	
	<div class="container excursions">
	    <div class="row">
        <font color="#000000">Города и экскурсии</font>
        
	        <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/sudak.jpg">
            <p style="font-size:1vw;" class="text-center">Судак</p>
            <p style="font-size:1vw;" class="text-center">7 экскурсий</p>
            </div>
            
        <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/yalta.jpeg">
            <p style="font-size:1vw;" class="text-center">Ялта</p>
            <p style="font-size:1vw;" class="text-center">57 экскурсий</p>
            </div>
            
        <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/alyshta.jpg">
            <p style="font-size:1vw;" class="text-center">Алушта</p>
            <p style="font-size:1vw;" class="text-center">56 экскурсий</p>
            </div>
            
        <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/balacklava2.jpg">
            <p style="font-size:1vw;" class="text-center">Балаклава</p>
            <p style="font-size:1vw;" class="text-center">14 экскурсий</p>
            </div>
            
            <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/simphiropol.jpg">
            <p style="font-size:1vw;" class="text-center">Симферополь</p>
            <p style="font-size:1vw;" class="text-center">11 экскурсий</p>
            </div>
            
            <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/kerch.jpg">
            <p style="font-size:1vw;" class="text-center">Керчь</p>
            <p style="font-size:1vw;" class="text-center">6 экскурсий</p>
            </div>
	        
	        <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/saki.jpg">
            <p style="font-size:1vw;" class="text-center">Саки</p>
            <p style="font-size:1vw;" class="text-center">3 экскурсий</p>
            </div>
            
            <div class="box1 col-12 col-md-6 col-lg-3 mx-auto">
            <img align="center" class="img-fluid" src="img/foros.jpg">
            <p style="font-size:1vw;" class="text-center">Форос</p>
            <p style="font-size:1vw;" class="text-center">8 экскурсий</p>
            </div>
            
	    </div>
	</div>
	
		<div class="container Sight">

        <font color="#000000">Достопримечательности</font>
        
        <div class="about">
<div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 mx-auto sight1">
         <h2><font color="#022337">1. Ласточкино гнездо (г. Ялта)</font></h2>
           <p><font color="#1f2c32">
            Ласточкино гнездо — замок на Южном берегу Крымского полуострова недалеко от Ялты. Замок стоит на высоте около 40 метров над уровнем моря на мысе Ай-Тодор, и сочетает в себе элементы исторической неоготики с ориенталистской архитектуры. После того как Крым был впервые аннексирован Россией в 1783 году, русский генерал построил здесь небольшой летний домик. Когда в XIX веке Ялта превратилась в популярный курорт, это имущество приобрела московская дама. Она снесла дом генерала и построила маленький замок. </font>
            </p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto desc sight2">
            <img align="center" src="img/lastochkino_gnezdo.jpg" >
            </div> 
	</div>
<div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 mx-auto sight1">
         <h2><font color="#022337">2. Воронцовский дворец (г. Алупка)</font></h2>
           <p><font color="#1f2c32">
            Воронцовский дворец — исторический памятник у подножия Крымских гор вблизи города Алупки. Является одним из старейших дворцов и самой популярной туристической достопримечательностью на Южном побережье полуострова. Со стороны моря дворец построен в мавританском стиле, а со стороны гор — в английском неоготическом. Всего в замке 150 комнат. Наиболее примечательными являются голубая комната, библиотека, столовая и китайский кабинет. Дворец окружен огромным парком, спроектированным немецким ландшафтным архитектором Карлом Кебахом. </font>
            </p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto desc sight2">
            
            <img align="center" src="img/Voronetsky_palace.jpg" >
            </div>   
	</div>
        
<div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 mx-auto sight1">
         <h2><font color="#022337">3. Ливадийский дворец (поселок Ливадия)</font></h2>
           <p><font color="#1f2c32">
            Ливадийский дворец являлся летней резиденцией последнего русского царя Николая II. Он расположен в Ливадии, пригороде Ялты, и был построен в 1910–1911 годах на месте предыдущего дворца. С 4 по 11 февраля 1945 года во дворце проходила Ялтинская конференция, на которой лидеры США (Франклин Д. Рузвельт), Великобритании (Уинстон Черчилль) и Советского Союза (Иосиф Сталин) вели переговоры о послевоенной Европе. Дворцовый комплекс был тщательно отреставрирован специально для этой конференции.</font>
            </p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto desc sight2">
            
            <img align="center" src="img/Livadia_Palace.jpg" >
            </div>   
	</div>	        
            
            <div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 mx-auto sight1">
         <h2><font color="#022337">4. Массандровский дворец (поселок Массандра)</font></h2>
           <p><font color="#1f2c32">
            Массандра — поселок городского типа, непосредственно примыкающий к Ялте на Южном субтропическом побережье Крымского полуострова. Массандра изначально развивалась как греческое поселение. В 1783 году Массандру приобрела дочь польского дворянина Льва Потоцкого, которая в первой половине XIX века начала строительство парка и замка площадью 80 гектаров. Позднее усадьбу приобрел генерал-губернатор Новороссии, а после его смерти она стала собственностью царя Александра III. Трёхэтажный замок-дворец построен во французском стиле XVII века. </font>
            </p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto desc sight2">
            
            <img align="center" src="img/Massandra_Palace.jpg" >
            </div>   
	        </div>
            
            
            <div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 mx-auto sight1">
         <h2><font color="#022337">5. Ханский дворец Бахчисарай (г. Бахчисарай)</font></h2>
           <p><font color="#1f2c32">
            Ханский дворец Бахчисарай был резиденцией правителей Крымского ханства, а его старейшие части датируются XVI веком. Сегодня в национальном святилище крымских татар находится музей. Название Бахчисарай происходит от турецкого языка и означает садовый дворец. Первоначально это название относилось только к Ханскому дворцу, но позже распространилось на весь город. Во дворе находится Фонтан Слез, вырезанный из цельного мраморного блока. Фонтан является памятником хана Кирим Гирея его покойной жене Дилиаре Бикич. Он был сделан придворным художником Омером примерно в 1764 году. Капли воды по-прежнему ритмично падают на две розы, лежащие на выступе. Многие поэты и художники вдохновлялись этим фонтаном, такие как Александр Пушкин или Адам Мицкевич.</font>
            </p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto desc sight2">
            
            <img align="center" src="img/Khan's palace Bakhchisarai.jpg" >
            </div>   
	        </div>
            
	    </div>
	</div>
	
	<div class="review" style="padding-bottom: 20px">
            <div class="col-11 col-md-9 col-lg-6 mx-auto" style="padding-bottom: 1rem; padding-top: 0.1rem;">
                <h3 style="text-align: center">Отзывы клиентов</h3>
            </div>
            
            <div class="review_inner">
                
                <div style="width: 20%; margin-left: 10%">
                    <div class="review_inner">
                        <img src="img/female.png" class="img-responsive" style="width: 30%; height: 30%">
                        <div>
                            <label style="font-weight: 500">Ирина М.</label>
                            <div class="review_inner">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                        </div>
                        </div>
                        
                    </div>
                    <label style="font-size:1vw;">Экскурсия очень понравилась. места восхитительные! Гид и водитель прекрасные!!!</label>
                </div>
                
                <div style="width: 20%; margin-left: 10%">
                    <div class="review_inner">
                        <img src="img/female.png" class="img-responsive" style="width: 30%; height: 30%">
                        <div>
                            <label style="font-weight: 500">Ольга П.</label>
                            <div class="review_inner">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                        </div>
                        </div>
                        
                    </div>
                    <label style="font-size:1vw;">Великолепная экскурсия, очень интересно и познавательно! Рекомендую</label>
                </div>
                
                <div style="width: 20%; margin-left: 10%">
                    <div class="review_inner">
                        <img src="img/male.png" class="img-responsive" style="width: 30%; height: 30%">
                        <div>
                            <label style="font-weight: 500">Владимир К.</label>
                            <div class="review_inner">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                                <img src="img/star.png" class="img-responsive" style="width: 13%">
                        </div>
                        </div>
                        
                    </div>
                    <label style="font-size:1vw;">Понравилась программа. Она была скорректирована с учетом моих пожеланий.</label>
                </div>
                
            </div>
        </div>
        
	</div>
	
		<div class="main_form">

            <div class="col-11 col-md-9 col-lg-6 mx-auto" style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <h3 style="text-align: center">Форма обратной связи</h3>
                </div>

            <form method="post" action="{{ route('bids.store') }}">
                @csrf
                <div class="col-11 col-md-9 col-lg-6 mx-auto" style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <label>Ваше имя</label>
                    <input type="text" class="form-control" id="formInputName" name="name">
                </div>
    
                <div class="col-11 col-md-9 col-lg-6 mx-auto" style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <label>Email-адрес</label>
                    <input type="email" class="form-control" id="formInputEmail" placeholder="name@mail.ru" name="email">
                    <small id="emailHelp" class="form-text text-muted">Данные не передаются третьим лицам</small>
                </div>
    
                <div class="col-11 col-md-9 col-lg-6 mx-auto"style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <label>Номер телефона</label>
                    <input type="tel" class="form-control bfh-phone" id="formInputPhone" maxlength="12" value="+7" name="telephone">
                </div>
    
                <div class="col-11 col-md-9 col-lg-6 mx-auto"style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <label>Сообщение:</label>
                    <textarea class="form-control" id="formInputMessage" name="text"></textarea>
                </div>
    
                <div class="col-11 col-md-9 col-lg-6 mx-auto"style="padding-bottom: 0.4rem; padding-top: 0.1rem;">
                    <button type="submit" class="btn btn-primary" id="submit">Отправить заявку</button>
                </div>
            </form>
            <br>

        </div>
	
	</div>
	

	
	<footer id="footer">
        <div class="container">
            <div class="footer_inner">
                <div class="footer_info">
                    <div class="footer_copyright">
                    © 2021 - IBM
                    </div>
                    <div class="footer_social">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-twitter ms-3"></i>
                        <i class="bi bi-facebook ms-3"></i>
                        <i class="bi bi-youtube ms-3"></i>
                    </div>
                </div>
                <div class="footer_nav">
                    +7-800-555-55-35
                </div>
            </div>
        </div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>