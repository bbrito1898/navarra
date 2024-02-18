<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Navarra - tEST</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3">Navarra</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">BRUNO BRITO</li>
                    </ol>
                    <div class="row">
                        <div class="row">
                            <div class="card bg-success text-white mb-4"
                                style="max-width: 48%;margin-right: 10px;background-color: #fff !important;text-align: center;">
                                @if($status)
                                    <div class="card-body" style="color: green !important;">Status OK</div>
                                @else
                                    <div class="card-body" style="color: red !important;">Status not OK</div>
                                @endif
                            </div>
                            <div class="card bg-success text-white mb-4"
                                style="max-width: 48%;margin-right: 10px;background-color: #fff !important;color: black !important;text-align: center;">
                                <div class="card-body">
                                    <span>{{ $contagem }}</span><br>
                                    <span>Registos</span>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Prioridades
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cesto</th>
                                                <th>País</th>
                                                <th>Quantidade</th>
                                                <th>Condições de Pagamento</th>
                                                <th>Previsão de Consumo</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Cesto</th>
                                                <th>País</th>
                                                <th>Quantidade</th>
                                                <th>Condições de Pagamento</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($importante as $item)
                                                <tr>
                                                    <td>{{ $item['id'] }}</td>
                                                    <td>{{ $item['cesto'] }}</td>
                                                    <td>{{ $item['pais'] }}</td>
                                                    <td>{{ $item['quantidade'] }}</td>
                                                    <td>{{ $item['condicao_pagamento'] }}</td>
                                                    <td>{{ $item['previsao_consumo'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-2"></i>
                                    Todos os Registos
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cesto</th>
                                                <th>País</th>
                                                <th>Quantidade</th>
                                                <th>Condições de Pagamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lista as $item)
                                                <tr>
                                                    <td>{{ $item['id'] }}</td>
                                                    <td>{{ $item['cesto'] }}</td>
                                                    <td>{{ $item['pais'] }}</td>
                                                    <td>{{ $item['quantidade'] }}</td>
                                                    <td>{{ $item['condicao_pagamento'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
