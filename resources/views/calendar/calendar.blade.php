<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{asset('fullcalendar/main.css')}}" rel='stylesheet' />
    <script src="{{asset('fullcalendar/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
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
                        <a class="nav-link active" aria-current="page" href="{{ route('calendar.index') }}">Расписание</a>
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

    <div class="container main">

        @if(session('success'))
            <div class="alert alert-success d-flex alert-dismissible fade show alert-file" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#check-circle-fill"/></svg>
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        <div id="calendar"></div>
        <script>var events = <?echo ($calendar_json); ?></script>

        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#windowModalCenter">
            Запустить модальное окно
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="windowModalCenter" tabindex="-1" aria-labelledby="windowModalCenter"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="windowModalCenter">Добавить событие</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <label for="title" class="col-form-label">Название события:</label>
                            <input type="text" class="form-control" id="title">
                            <label for="description" class="col-form-label">Описание маршрута:</label>
                            <textarea class="form-control" id="description" name="note" rows="3"></textarea>
                            <!-- <label for="date-begin" class="col-form-label">Начало события:</label>
                            <input type="date" class="form-control" id="date-begin"> -->
                            <label for="date-end" class="col-form-label">Конец события:</label>
                            <input type="date" class="form-control" id="date-end">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" id="add-event" class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="windowModalCenter2" tabindex="-1" aria-labelledby="windowModalCenter2"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="windowModalCenter2">Добавить событие</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit" method="post" action="">
                            @csrf
                            <label for="title-edit" class="col-form-label">Название события:</label>
                            <input type="text" class="form-control" id="title-edit" name="title_edit">
                            <label for="description-edit" class="col-form-label">Описание маршрута:</label>
                            <textarea class="form-control" id="description-edit" name="description_edit" rows="3"></textarea>
                            <label for="date-begin-edit" class="col-form-label">Начало события:</label>
                            <input type="date" class="form-control" id="date-begin-edit" name="date_begin">
                            <label for="date-end-edit" class="col-form-label">Конец события:</label>
                            <input type="date" class="form-control" id="date-end-edit" name="date_end">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Редактировать</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <form id="form-delete" method="post" action="">
                            @csrf
                            @method('DELETE')
                        <button id="delete-event" type="submit" class="btn btn-danger" data-id="">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="{{asset('js/calendar.js')}}"></script>
</body>

</html>