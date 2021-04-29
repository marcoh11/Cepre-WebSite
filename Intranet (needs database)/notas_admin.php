<?php 

session_start();
require "conection.php";
if(!isset($_SESSION['id'])){
header("Location: login.php");
}
$idAlumno=$_SESSION['id'];
    $errors = array();
    //(Falta recibir el id anterior)
    $año='2020';
    //sacar el nombre del alumno
    $sql1 = "Select * from alumno where idAlumno=$idAlumno";
    $nombres = $mysqli->query($sql1);
    $row1 = $nombres->fetch_assoc();
    //Consultas
    $sql = "SELECT idAlumno , AVG(total)  as promedio from examen_nota GROUP by idAlumno ORDER by promedio DESC";
    $resultado = $mysqli-> query($sql);
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
    <title>Pre UNAC | Administrador</title>

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
    <!-- Script para confirmacion de subir notas -->
<script>
    function confirmupdate()
     {
       var respuesta = confirm("Estas seguro que quieres subir las notas?");
       if (respuesta == true)
       {
        return true;
        }
        else
        {
        return false;
        } 
      }
      function confirmdelete()
     {
       var respuesta = confirm("Estas seguro que quieres eliminar las ultimas notas?");
       if (respuesta == true)
       {
        return true;
        }
        else
        {
        return false;
        } 
      }
</script>
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
                        
                        <a class="collapse-item" href="alumnos_admin.php">Ver Lista de Alumnos</a>
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
                <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Acciones : </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 


                                            <div class="row">


                                                <div class="m-2 pb-1 col-6 col-sm-4">
                                                <form  method="POST" action="notas_update.php">
                                                <input type="submit" class="btn btn-primary" value="Subir Notas" name="btnsubir" onclick="return confirmupdate()"></input>
                                                </form> 
                                                </div>


                                                <div class="col-md-2 offset-md-5">
                                                <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                                                </div>

                                                <div class="w-100"></div>  
                                                
                                                <div class="m-2 pb-1 col-6 col-sm-4">
                                                <form  method="POST" action="delete.php">
                                                <input type="submit" class="btn btn-danger" value="Eliminar ultimo Examen" name="btneliminar" onclick="return confirmdelete()"></input>
                                                </form>
                                                </div>

                                                <div class="col-md-2 offset-md-5">
                                                <i class="fas fa-trash-alt fa-2x text-gray-300"></i>
                                                </div>

                                            </div>


                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Notas</h1>
                    <p class="mb-4" >A continuación se le mostrara el estado de las notas, también se podrá actualizar y eliminar los resultados de los últimos exámenes.</p>
                    <p class="mb-4 text-danger">*Los cambios realizados serán responsabilidad del administrador que los realice, además estos cambios deberán ser notificados antes de ralizarlos.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Nota de alumno</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Alumno</th>
                                            <th>Carrera</th>
                                            <th>Examenes Subidos</th>
                                            <th>Estado</th>  
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Alumno</th>
                                            <th>Carrera</th>
                                            <th>Examenes Subidos</th>
                                            <th>Estado</th>  
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        while ($row = $resultado->fetch_assoc()){                
                                        ?>
                                        <tr>
                                            <td><a href="notas_admin_user.php?idInvitado=<?php echo $row['idAlumno'];?>">
                                            <?php 
                                            $id = $row['idAlumno'];
                                            echo $id;
                                            $sql2 = "Select * from alumno where idAlumno=$id";
                                            $nombres2 = $mysqli->query($sql2);
                                            $row2 = $nombres2->fetch_assoc();
                                            ?></a></td>
                                            <td><?php echo $row2['nombre']," ",ucwords($row2['apellido']);?></td>
                                            <td><?php   
                                            $sql3 = "Select carrera from alumno_detalle where idalum=$id";
                                            $nombres3 = $mysqli->query($sql3);
                                            $row3 = $nombres3->fetch_assoc();
                                            echo $row3['carrera'];
                                            ?></td>
                                            <td>
                                            <?php
                                            $sql4 = "Select idExamen from examen_curso where idAlumno=$id";
                                            $nombres4 = $mysqli->query($sql4);
                                            while ($row4= $nombres4->fetch_assoc()){ 
                                            echo $row4['idExamen']," || ";}
                                            ?>
                                            </td>
                                            <th><?php echo round($row['promedio'],2);?></th>
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