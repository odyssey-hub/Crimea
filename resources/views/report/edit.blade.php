<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset("css/reports.css")}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
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
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdown07" data-bs-toggle="dropdown"
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

    <div class="container wrap main">

        <form action="{{ route('reports.update', ['id' => $report->id]) }}" method="post" enctype="multipart/form-data" class="col-lg-6 offset-lg-3">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="date" class="form-label">Дата написания отчета</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ old('date') ?? $report->date ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="nameFile" class="form-label">Название файла</label>
                <input type="text" name="name" class="form-control" id="nameFile" placeholder="Имя файла" value="{{ old('name') ?? $report->name ?? '' }}" required>
            </div>

			<div class="mb-3">
                <label for="inputState" class="form-label">Выберете тип отчета</label>
                <select id="inputState" class="form-control" name="type">
                    @if($report->type == "Недельный отчет")
                    <option value = "1" selected>Недельный отчет</option>
                    <option value = "2">Бухгалтерский отчет</option>
                    @else
                    <option value = "1">Недельный отчет</option>
                    <option value = "2" selected>Бухгалтерский отчет</option>
                    @endif
                </select>
            </div>

			<div class="mb-3">
                <label for="notes" class="form-label">Заметки по отчету</label>
                <textarea class="form-control" id="notes" name="note" rows="3">{{ old('note') ?? $report->note ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <!-- <label for="formControlFile">Файл с отчетом</label>
                <input type="file" class="form-control-file" id="formControlFile" name="file"> -->

                <div class="form-file">
                    <input type="file" class="form-file-input" id="formControlFile" name="report">
                    <label class="form-file-label" for="formControlFile">
                        <!-- <span class="form-file-text">Choose file...</span>
                        <span class="form-file-button">Browse</span> -->
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Изменить</button>

            <div id="result"></div>
        </form>

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
    <script src="{{asset("js/reports.js")}}"></script>
</body>

</html>
