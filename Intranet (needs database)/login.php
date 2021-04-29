<?php 
  require "conection.php";  
  require 'funciones.php';
  session_start();
  $errors = array();
  if(isset($_SESSION['id'])){
    if($_SESSION['tipoUsuario']==0){
        header("Location: index.php");}
    else{
        header("Location: indexadmin.php");
    } 
  }
  if($_POST){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $sql= "SELECT * FROM alumno_usuario WHERE usuario='$usuario'";
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;
    if($num>0){
    $row = $resultado->fetch_assoc();
    $password_bd = $row['password'];
    if($password_bd == $password){
        $_SESSION['id']=$row['id']; 
        $_SESSION['tipoUsuario']=$row['TipoUsuario'];
        if($_SESSION['tipoUsuario']==0){
            header("Location: index.php");}
        else{
            header("Location: indexadmin.php");
        } 
    } else{
        $errors[]="La contraseña no coincide";
    }
    } else{
    $errors[]="El usuario no existe";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="img/logo.png">
        <title>Pre UNAC | Intranet</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Centro Pre-Universitario UNAC</h3>
                                    <h3 class="text-center font-weight-light my-4"><img class="site-logo" src="img/logo.png" alt="Logo" width="150px"></h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                                <input class="form-control py-4" name="usuario" id="inputEmailAddress" type="email" placeholder="Introduce tu usuario" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Ingresa tu contraseña" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Recuerdame</label>
                                                </div>
                                            </div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Ingresar
                                                </button>
                                        </form>
                                        <?php echo resultBlock($errors);?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Centro Pre Universitario de la Universidad Nacional del Callao 2020</div>
                            <div>
                              
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
