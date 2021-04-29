<?php 
    session_start();
    if(!isset($_SESSION['id'])){
    header("Location: login.php");
    }
    if(($_SESSION['id'])==0){
        header("Location: indexadmin.php");
    }
    $idAlumno=$_SESSION['id'];
    $año='2020';
    require "conection.php";
    $sql = "Select * from alumno_detalle where idalum=$idAlumno";
    $resultado = $mysqli->query($sql);
    $row=$resultado->fetch_assoc();
    //panel de control 1
    $sql1 = "Select * from alumno where idAlumno=$idAlumno";
    $nombres = $mysqli->query($sql1);
    $row1 = $nombres->fetch_assoc();
    //panel de control 2
    $consulta1 = "select *  FROM examen_nota where idAlumno=$idAlumno ORDER BY idExamen DESC LIMIT 1";
    $resultado1 = mysqli_query($mysqli,$consulta1);
    $row3 = mysqli_fetch_assoc($resultado1);
    $correctas = $row3['buenas'];
    $incorrectas = $row3['malas'];
    $enblanco = $row3['enBlanco'];
    //Average
    $sql4 = "SELECT AVG(total) AS PROMEDIO FROM examen_nota WHERE idAlumno=$idAlumno AND SUBSTRING(idExamen,1,4)=$año";
    $resultado4 = $mysqli->query($sql4);
    $row4 = $resultado4->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/logo.png">

    <title>Pre UNAC | Intranet</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
 <!-- Sidebar - Brand -->
             <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" > <img class="site-logo" src="img/logo.png" alt="Logo" width="45px">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Cepre Unac <sup></sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Panel Principal</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interfaz de Usuario
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-alt"></i>
                    <span>Evaluaciones</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">            
                        <a class="collapse-item" href="notas.php">Notas</a>
                        <a class="collapse-item" href="ranking.php">Ranking</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Material Educativo</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="https://drive.google.com/drive/folders/1xLoSL-mZAVuUSquPAvynEuDvpWihzYu7"target="_blank">Solucionario Números</a>
                        <a class="collapse-item" href="https://drive.google.com/drive/folders/1CH8k7sy50vjeEAu6dHeStDg3ASaf-8Zm"target="_blank">Solucionario Letras</a>
                        <a class="collapse-item" href="https://drive.google.com/drive/folders/1owSTxOQ2bWcZXEssqLgau49J61WIjD93"target="_blank">Libros</a>
                    </div>
                </div>  
            </li>
<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="cronograma.php">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Cronograma</span></a>
            </li>
            <!-- Divider -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php 
                                                echo $row1 ['nombre'],' ', $row1 ['apellido'];
                                            ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Grupo: </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                                echo $row ['grupo'];
                                            ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Carrera: </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                                echo $row ['carrera'];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nota Promedio: 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo round($row4['PROMEDIO'],2);?>/100</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo round($row4['PROMEDIO'],2);?>%" aria-valuenow="<?php echo round($row4['PROMEDIO'],2);?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-file-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Turno: </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                                echo $row ['turno'];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Puntaje Mínimo 2019-II</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Resultados del último exámen</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>

                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Correctas
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Incorrectas
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> En blanco
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Vacantes brindadas por la CEPRE</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Administración<span
                                            class="float-right">5</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 9%"
                                            aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Contabilidad <span
                                            class="float-right">4</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Economía <span
                                            class="float-right">3</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 11%"
                                            aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Matemática <span
                                            class="float-right">3</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Física <span
                                        class="float-right">2</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 20%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Enfermería <span
                                    class="float-right">2</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 21%"
                                    aria-valuenow="21" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Educación Física <span
                                class="float-right">3</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 18%"
                                aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Ing. Ambiental y RR. NN <span
                            class="float-right">5</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%"
                            aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Ing. Eléctrica <span
                        class="float-right">5</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 19%"
                        aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Ing. Electrónica <span
                    class="float-right">5</span></h4>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: 19%"
                    aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Ing. Industrial <span
                class="float-right">3</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 18%"
                aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Ing. Sistemas <span
            class="float-right">4</span></h4>
    <div class="progress mb-4">
        <div class="progress-bar bg-success role="progressbar" style="width: 18%"
            aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <h4 class="small font-weight-bold">Ing. Mecánica <span
        class="float-right">6</span></h4>
<div class="progress mb-4">
    <div class="progress-bar bg-secondary" role="progressbar" style="width: 15%"
        aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<h4 class="small font-weight-bold">Ing. Energía <span
    class="float-right">5</span></h4>
<div class="progress mb-4">
<div class="progress-bar bg-dark" role="progressbar" style="width: 19%"
    aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<h4 class="small font-weight-bold">Ing. Pesquera <span
    class="float-right">4</span></h4>
<div class="progress mb-4">
<div class="progress-bar" role="progressbar" style="width: 25%"
    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<h4 class="small font-weight-bold">Ing. Alimentos <span
    class="float-right">5</span></h4>
<div class="progress mb-4">
<div class="progress-bar bg-warning" role="progressbar" style="width: 25%"
    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
                                    <h4 class="small font-weight-bold">Ing. Química <span
                                            class="float-right">2</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 17%"
                                            aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Comunicado</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 50rem;"
                                            src="https://cepre.unac.edu.pe/img/comunic003-coronavirus.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Centro Pre Universitario de la Universidad Nacional del Callao 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer-->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona " Salir " si deseas salir de la sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script>
       var correctas = <?php echo json_encode($correctas); ?>
    </script>
    <script>
       var incorrectas = <?php echo json_encode($incorrectas); ?>
    
    </script>
        <script>
       var enblanco = <?php echo json_encode($enblanco); ?>
    </script>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Corretas", "Incorrectas", "En blanco"],
    datasets: [{
      data: [correctas, incorrectas, enblanco],
      backgroundColor: ['#1cc88a', '#e74a3b', '#f6c23e'],
      hoverBackgroundColor: ['#007bff', '#007bff', '#007bff'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
    </script>

</body>

</html>