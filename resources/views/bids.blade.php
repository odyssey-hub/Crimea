<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/layout.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">

    <title>Просмотр заявок</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="{{asset("js/bids.js")}}"></script>
</head>

<body>
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
                        <a class="nav-link" aria-current="page" href="{{ route('main_page') }}">Главная страница</a>
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
                        <a class="nav-link active" aria-current="page" href="{{ route('bids.index') }}">Заявки</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
<div class="main">
    <div class="d-flex justify-content-center">
        <div>
            {{$bids->links()}}
        </div>
    {{--    <div>--}}
    {{--        <nav aria-label="Page navigation example">--}}
    {{--            <ul class="pagination">--}}
    {{--                <li class="page-item"><a class="page-link" href="#">Назад</a></li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">Дальше</a></li>--}}
    {{--            </ul>--}}
    {{--        </nav>--}}
    {{--    </div>--}}
    </div>
    
    <div class="cards-bids px-5">
        @foreach($bids as $bid)
        <div class="card text-center p-0 mt-5" data-id="{{$bid->id}}">
            <div class="card-header d-flex justify-content-between text-light bg-info">
                <div class="fs-5">{{$bid->Email}}</div>
                <div class="fs-5">{{$bid->Phone}}</div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$bid->FIO}}</h5>
                <p class="card-text">{{$bid->Text}}</p>
                <button type="submit" class="btn btn-primary btnBidDel">Прочитано</button>
            </div>
            <div class="card-footer text-muted">
                {{$bid->created_at}}
            </div>
        </div>
        @endforeach
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

</body>

</html>
