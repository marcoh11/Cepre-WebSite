<?php 
session_start();
require "conection.php";
if(!isset($_SESSION['id'])){
header("Location: login.php");
}
    $idAlumno=$_SESSION['id'];
    $año='2020';
    //sacar el nombre y apellido del alumno
    $sql1 = "Select * from alumno where idAlumno=$idAlumno";
    $nombres = $mysqli->query($sql1);
    $row1 = $nombres->fetch_assoc();
    //Consultas
    $sql = "SELECT idAlumno , AVG(total)  as promedio from examen_nota GROUP by idAlumno ORDER by promedio DESC";
    $resultado = $mysqli-> query($sql);

    $sql2 ="SELECT COUNT(idExamen) as contador from examen_nota WHERE idAlumno=$idAlumno";
    $resultado2 = $mysqli->query($sql2);
    $row2 = $resultado2->fetch_assoc();
    // Resultados del 1er examen
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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php"> <img class="site-logo" src="img/logo.png" alt="Logo" width="45px">
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
</ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- Nav Item - Alerts -->
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
                                <!-- <div class="dropdown-divider"></div> -->
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
                    <h1 class="h3 mb-2 text-gray-800">Ranking</h1>
                    <p class="mb-4">A continuación se le mostrara el ranking de alumnos agrupados por el mayor puntaje, si tiene alguna consulta mandenos un mensaje a nuestra <a target="_blank"
                            href="https://www.facebook.com/CEPREUNAC1986">Red Social</a>.</p>
                            <div class="card-body col-xl-5 col-md-3 mb-4">   
                    <ul class="list-group">
                    <?php
                    if($row2['contador']==4){
                    echo '<li class="list-group-item list-group-item-success">Todos los examenes se subieron : Revisa tu estado en la tabla inferior te deseamos exitos..!</li>';}
                    ?>
                    </ul>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ranking de alumnos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Carrera</th>
                                            <th>Turno</th>
                                            <th>Promedio</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Carrera</th>
                                            <th>Turno</th>
                                            <th>Promedio</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        while ($row = $resultado->fetch_assoc()){                
                                        ?>
                                        <tr>
                                            <td><?php 
                                            $id = $row['idAlumno'];
                                            $sql2 = "Select * from alumno where idAlumno=$id";
                                            $nombres2 = $mysqli->query($sql2);
                                            $row2 = $nombres2->fetch_assoc();
                                            echo $row2['nombre'];
                                            ?></td>
                                            <td><?php echo ucwords($row2['apellido']);?></td>
                                            <td><?php   
                                            $sql3 = "Select * from alumno_detalle where idalum=$id";
                                            $nombres3 = $mysqli->query($sql3);
                                            $row3 = $nombres3->fetch_assoc();
                                            echo $row3['carrera'];
                                            ?></td>
                                            <td><?php 
                                            echo $row3['turno'];
                                            ?></td>
                                            <th><?php echo round($row['promedio'],2)?></th>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
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
            <!-- End of Footer -->

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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>