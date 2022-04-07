<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">

    <title>Редактирование маршрутов</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=5baa014e-f93b-4f23-9fae-7f17f7e710d2"
            type="text/javascript"></script>
    <script src="{{asset("js/admin_map.js")}}" type="text/javascript"></script>
    <script src="{{asset("js/autocomplete.js")}}" type="text/javascript"></script>
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
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdown07" data-bs-toggle="dropdown"
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


<div class="main">
    <div class="main-content row">
        <div class="mysidebar col-lg-4">
            <div class="places-search row">
                <label class="form-label required w-auto pt-1" for="route_places">Места</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="route_places" id="route_places"
                           placeholder="Введите места через ," required>
                </div>
            </div>
    {{--        <div class="row sort-fields mt-2">--}}
    {{--            <div class="col-lg">--}}
    {{--                <select class="form-select" aria-label="Default select example">--}}
    {{--                    <option value="field_cost" selected>По цене</option>--}}
    {{--
    {{--                    <option value="field_duration">По длительности</option>--}}
    {{--                </select>--}}
    {{--            </div>--}}
    {{--            <div class="col-lg">--}}
    {{--                <select class="form-select" aria-label="Default select example">--}}
    {{--                    <option value="order_asc" selected>По возрастанию</option>--}}
    {{--                    <option value="order_desc">По убыванию</option>--}}
    {{--                </select>--}}
    {{--            </div>--}}
    {{--        </div>--}}
            <div class="cards mt-2">
                @foreach($routes as $route)
                    <div class="card" data-route-id="{{$route->id}}">
                                <h5 class="card-header">
                                    {{$route->name}}
                        </h5>
                        <div class="card-body bg-light">
                            <p class="card-text">{{$route->attractions}}</p>
                            <div class="card-funcs">
                                <button type="button" class="btn btn-primary btnShowRouteInfo" data-name="{{$route->name}}"
                                        data-gid="{{$route->gid}}" data-objects="{{$route->attractions}}"
                                        data-time="{{$route->duration[0]}}{{$route->duration[1]}} часов {{$route->duration[3]}}{{$route->duration[4]}} минут"
                                        data-desc="{{$route->description}}"
                                        data-cost="{{$route->cost}}">Подробнее
                                </button>
                                <i class="bi bi-pencil-square" data-route-id="{{$route->id}}"></i>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cards-buttons mt-2">
                <button type="button" class="btn btn-success" id="btnAddRoute" data-bs-toggle="modal"
                        data-bs-target="#modal_form">Добавить
                </button>
                <button type="button" class="btn btn-danger" id="btnDeleteRoute" data-bs-toggle="modal"
                        data-bs-target="#modal_delete">Удалить
                </button>
            </div>

        </div>

        <div class="col-lg-8">
            <div id="map"></div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="modal fade" id="modal_form">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление маршрута</h5>
                        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formAddRoute" class="needs-validation" novalidate>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label required" for="route_name">Название маршрута</label>
                                <input class="form-control" type="text" name="route_name" id="route_name" minlength="3"
                                       maxlength="255" placeholder="Введите название маршрута" required>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите название маршрута
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label required" for="route_desc">Описание</label>
                                <textarea class="form-control" name="route_desc" id="route_desc" cols="30"
                                          placeholder="Введите описание маршрута" maxlength="65536" required></textarea>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите описание маршрута
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label required" for="route_obj">Посещаемые объекты</label>
                                <textarea class="form-control" name="route_objs" id="route_objs" cols="30"
                                          placeholder="Введите посещаемые объекты в течении пути через запятую"
                                          maxlength="65536" required></textarea>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите посещаемые объекты
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label required" for="route_cost">Стоимость</label>
                                <input class="form-control" type="number" name="route_cost" id="route_cost"
                                       placeholder="Введите стоимость маршрута" min="1" max="500000" required>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите стоимость маршрута
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label required" for="route_time">Длительность</label>
                                <input class="form-control" type="text" name="route_time" id="route_time" maxlength="255"
                                       placeholder="Введите длительность маршрута в формате чч:мм(02:30)"
                                       pattern="[0-9][0-9]:[0-5][0-9]" required>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите длительность маршрута
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label required" for="route_gid">Эксурсовод</label>
                                <input class="form-control" type="text" name="route_gid" id="route_gid" maxlength="255"
                                       placeholder="Введите ФИО экскурсовода" required>
                                <div class="valid-feedback">
                                    Все хорошо!
                                </div>
                                <div class="invalid-feedback">
                                    Укажите гида маршрута
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="modalBtnAdd">Принять</button>
                            <button type="button" class="btn btn-danger" id="modalBtnCancel" data-bs-dismiss="modal" aria-label="Close">Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

<div class="modal fade" id="modal_delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Подтверждение удаления</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Вы точно хотите удалить данный маршрут ?
            </div>
            <div class="modal-footer modal-footer-delete justify-content-around">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-danger" id="modalBtnDelConfirm">Да</button>
            </div>
        </div>
    </div>
</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastRouteAddConfirm" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-info">
            <strong class="me-auto">Маршрут добавлен</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            Маршрут успешно добавлен
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastRouteDeleteConfirm" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-info">
            <strong class="me-auto">Маршрут удален</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            Маршрут успешно удален
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastRoutePath" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-info">
            <strong class="me-auto text-light">Путь изменен</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            Путь маршрута успешно изменен
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRoute" aria-labelledby="offcanvasRightLabel"
     data-bs-scroll="true" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Данные маршрута</h5>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h6>Название маршрута</h6>
        <p id="textRouteName">Lorem ipsum dolor sit amet consectetur adipisicing elit. At, alias!</p>
        <h6>Описание маршрута</h6>
        <p id="textRouteDesc">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Doloremque numquam et harum earum omnis cupiditate beatae natus repudiandae at adipisci?</p>
        <h6>Посещаемые объекты</h6>
        <p id="textRouteObjects">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Doloremque numquam et harum earum omnis cupiditate beatae natus repudiandae at adipisci?</p>
        <h6>Стоимость маршрута</h6>
        <p><span id="textRouteCost"></span>руб.</p>
        <h6>Эксурсовод</h6>
        <p id="textRouteGid">Lorem, ipsum dolor.</p>
        <h6>Длительность маршрута</h6>
        <p id="textRouteTime">Lorem, ipsum dolor.</p>

    </div>
</div>




<script src="{{asset("js/modals.js")}}" type="text/javascript"></script>

</body>

</html>
