<?php 
    session_start();
    require "conection.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    if($_SESSION['tipoUsuario']==0){
        header("Location: index.php");}
    $idAlumno=$_SESSION['id'];
    $sql = "Select count(*) from alumno";
    $resultado = $mysqli->query($sql);
    $row=$resultado->fetch_assoc();
    //datos de alumno
    $sql1 = "Select * from alumno where idAlumno=$idAlumno";
    $resultado1 = $mysqli->query($sql1);
    $row1 = $resultado1->fetch_assoc();
    //mostrar datos
    include('bd/conex.php');
    $id = $_GET["id"];
    $alumno = "SELECT C.idAlumno, nombre, apellido, correo,telefono,dni,carrera, grupo,turno,password
    FROM alumno C INNER JOIN alumno_detalle O ON C.idAlumno = O.idalum
    INNER JOIN alumno_usuario U ON O.idalum = U.id
    where idAlumno='$id'";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/logo.png">

    <title>Pre UNAC | Administrador</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexadmin.php"> <img class="site-logo" src="img/logo.png" alt="Logo" width="45px">

                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text mx-3">Cepre UNAC </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="indexadmin.php">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-file-alt"></i>
                    <span>Evaluaciones</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="collapseOne"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="notas_admin.php">Notas</a>
                        <a class="collapse-item" href="ranking_admin.php">Ranking</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Alumnos</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="collapseUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="alumnos_admin.php">Lista de Alumnos</a>
                        <a class="collapse-item" href="registrar_alumno.php">Agregar Alumno</a>
                       
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="#collapseTwo">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Cronograma</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="cronograma_admin.php">Anuncios</a>
                     
                       
                    </div>
                </div>
            </li>
<!-- Nav Item - Pages Collapse Menu -->
            <!-- Divider -->
            <hr class="sidebar-divider">
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
                    <div class="container">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style=" margin-left: 200px; margin-right: -300px; text-align: center;">
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" style="text-align: center;">Editar alumno</h1>
                                    </div>
                                    <form class="user" action="#" method="post">
                                    <?php 
                                    include ('bd/conex.php');
                                    $resultado = $mysqli-> query($alumno);
                                    while ($row = mysqli_fetch_assoc($resultado)) {?>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="nombre" class="form-control form-control-user" value="<?php echo $row["nombre"]?>" id="exampleFirstName" placeholder="Nombre">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="apellido" class="form-control form-control-user" value="<?php echo $row["apellido"]?>" id="exampleLastName" placeholder="Apellidos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="correo" class="form-control form-control-user" value="<?php echo $row["correo"]?>" id="exampleInputEmail" placeholder="Correo">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="telefono" class="form-control form-control-user" value="<?php echo $row["telefono"]?>" id="exampleInputPassword" placeholder="Teléfono">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="dni" class="form-control form-control-user" value="<?php echo $row["dni"]?>" id="exampleRepeatPassword" placeholder="DNI">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="carrera" class="form-control form-control-user" value="<?php echo $row["carrera"]?>" id="exampleInputEmail" placeholder="Carrera">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="grupo" class="form-control form-control-user" value="<?php echo $row["grupo"]?>" id="exampleInputPassword" placeholder="Grupo">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="turno" class="form-control form-control-user" value="<?php echo $row["turno"]?>" id="exampleRepeatPassword" placeholder="Turno">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="password" class="form-control form-control-user" value="<?php echo $row["password"]?>" id="exampleInputEmail" placeholder="Contraseña">
                                        </div>
                                        <input type="submit" class="btn btn-success " name="update" value=" Actualizar ">
                                        <?php  } mysqli_free_result($resultado);?>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo2.js"></script>
</body>

</html>
<?php
    include('bd/conex.php');
    if(isset($_POST["update"])){
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $dni = $_POST["dni"];
        $carrera = $_POST["carrera"];
        $grupo = $_POST["grupo"];
        $turno = $_POST["turno"];
        $contraseña = $_POST["password"];

        //actualizar datos
        $actualizar ="UPDATE alumno SET nombre='$nombre', apellido='$apellido', correo='$correo', telefono='$telefono', dni='$dni'
                        where idAlumno='$id'";
        $actualizar1 = "UPDATE alumno_detalle INNER JOIN alumno ON alumno_detalle.idalum = alumno.idAlumno SET 
                        carrera='$carrera',grupo='$grupo',turno='$turno' where idAlumno='$id'";
        $actualizar2 = "UPDATE alumno_usuario INNER JOIN alumno ON alumno_usuario.id = alumno.idAlumno SET 
                        usuario='$correo',password='$contraseña' where idAlumno='$id'";

        $ejecutarupdate = mysqli_query($conexion,$actualizar);
        $ejecutarupdate1 = mysqli_query($conexion,$actualizar1);
        $ejecutarupdate2 = mysqli_query($conexion,$actualizar2);

        if(!$ejecutarupdate && !$ejecutarupdate1 && !$ejecutarupdate2){
            echo "No se actualizo";
        }else{
            echo "<script>alert('Se actualizaron correctamente los datos'); window.location='alumnos_admin.php';</script>";
        }
    }