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
                        <a class="nav-link" aria-current="page" href="{{ route('main_page') }}">?????????????? ????????????????</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-bs-toggle="dropdown"
                            aria-expanded="false">????????????????</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown07">
                            <li><a class="dropdown-item" href="{{ route('routes.index') }}">???????????????? ??????????????????</a></li>
                            @auth
                                <li><a class="dropdown-item" href="{{ route('routes.admin') }}">???????????????????????????? ??????????????????</a></li>
                            @endauth
                        </ul>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('calendar.index') }}">????????????????????</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdown07" data-bs-toggle="dropdown"
                            aria-expanded="false">????????????</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown07">
                            <li><a class="dropdown-item" href="{{ route('reports.create') }}">???????????????????? ????????????</a></li>
                            <li><a class="dropdown-item" href="{{ route('reports.index') }}">???????????????? ???????????? ??????????????</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('bids.index') }}">????????????</a>
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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="??????????????"></button>
        </div>
    @endif

    <div class="container wrap main">

        <div class="row block-list-reports">

            <div class="col-lg-6">
                <h3 class="text-center">?????????????????? ????????????</h3>
                <div class="accordion list-group scroll-button" id="accounting-reports">
                    <?$temp_id = 0;?>
                    @foreach($reports as $report)
                    
                    @if($report->type == "?????????????????? ??????????")
                    <div class='accordion-item'>
                        <h2 class='accordion-header' id = <?echo "flush-heading".$temp_id;?> >
                        <button class='accordion-button collapsed list-group-item list-group-item-action' type='button' data-id={{ $report->id }} data-bs-toggle='collapse' data-bs-target=<?echo "#flush-collapse".$temp_id;?> aria-expanded='false' aria-controls=<?echo "flush-collapse".$temp_id;?>>
                        {{ $report->name }}
                        </button>
                        </h2>
                        <div id=<?echo "flush-collapse".$temp_id;?> class='accordion-collapse collapse' aria-labelledby=<?echo "flush-heading".$temp_id;?> data-bs-parent='#accounting-reports'>
                            <div class='accordion-body'>
                                ???????? ?????????????????? ????????????: {{ $report->date }} <br>
                                ??????????????: {{ $report->note }}
                            </div>
                        </div>
                    </div>
                    <?$temp_id++;?>
                    @endif

                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <h3 class="text-center">?????????????????????????? ????????????</h3>
                <div class="accordion list-group scroll-button" id="accounting-reports2">
                    @foreach($reports as $report)
                    
                    @if($report->type == "?????????????????????????? ??????????")
                    <div class='accordion-item'>
                        <h2 class='accordion-header' id = <?echo "flush-heading".$temp_id;?> >
                        <button class='accordion-button collapsed list-group-item list-group-item-action' type='button' data-id={{ $report->id }} data-bs-toggle='collapse' data-bs-target=<?echo "#flush-collapse".$temp_id;?> aria-expanded='false' aria-controls=<?echo "flush-collapse".$temp_id;?>>
                        {{ $report->name }}
                        </button>
                        </h2>
                        <div id=<?echo "flush-collapse".$temp_id;?> class='accordion-collapse collapse' aria-labelledby=<?echo "flush-heading".$temp_id;?> data-bs-parent='#accounting-reports2'>
                            <div class='accordion-body'>
                                ???????? ?????????????????? ????????????: {{ $report->date }} <br>
                                ??????????????: {{ $report->note }}
                            </div>
                        </div>
                    </div>
                    <?$temp_id++;?>
                    @endif

                    @endforeach
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-4 mt-5">
                <a href="{{ route('reports.download', ['id' => $report->id]) }}" type="button" id="download-file" class="btn btn-success">??????????????</a>
                <a href="{{ route('reports.edit', ['id' => $report->id]) }}" type="button" id="edit-file" class="btn btn-warning">????????????????</a>
                <form action="{{ route('reports.destroy', ['id' => $report->id]) }}" method="post" enctype="multipart/form-data" id="destroy-file" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">??????????????</button>
                </form>
            </div>
        </div>

    </div>


    <footer id="footer">
        <div class="container">
            <div class="footer_inner">
                <div class="footer_info">
                    <div class="footer_copyright">
                    ?? 2021 - IBM
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