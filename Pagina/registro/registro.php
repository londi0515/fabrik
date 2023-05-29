<!DOCTYPE html>
<html lang="es">
    <!--Modelos-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="registro.css">
    <script src="https://kit.fontawesome.com/c9fb004c70.js" crossorigin="anonymous"></script>
    <title>Registro</title>
    <link rel="icon" href="recursos/icono_fabrik.png">
</head>
<body>
    <div id="contenedor_principal">
        <header id="cabecera">
            <div id="fondo_cabecera"></div>
        </header>
        <nav id="navegador">
            <div id="contenedor_navegador">
              <ul class="menu">
                <li id="inicio"><a href="../Inicio/inicio.html">Inicio</a></li>
                <li><a href="../Code/code.html">Code</a></li>
                <li><a href="../150/150.html">150</a></li>
                <li><a href="../Univesiparty/universiparty.html">Universiparty</a></li>
                <li><a href="../Row/row.html">Row</a></li>
                <li id="user"><a href="../Inicio_sesion/inicio_sesion.php"><i class="fa-sharp fa-solid fa-bars"></i>&nbsp;Socios</a></li>
              </ul>
            </div>
          </nav>    
        <section id="cuerpo">
          <div id="contenedor_registro">
            <div id="formulario">
            <?php
            if(isset($_POST['enviar'])){
              $cod_cliente=$_POST['cod_cliente'] + 1;
              $username=$_POST['username'];
              $password=$_POST['password'];
              $dni=$_POST['dni'];
              $nombre=$_POST['nombre'];
              $apellidos=$_POST['apellidos'];
              $correo=$_POST['correo'];
              $fec_nacimiento=$_POST['fecha_nacimiento'];
              $telefono=$_POST['telefono'];
              $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
              mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");

              $instruccion2 = "INSERT INTO Clientes (cod_cliente, username, password, dni, nombre, apellidos, correo, telefono, fecha_nacimiento)
              VALUES (".$cod_cliente.",'" .$username."','".$password."','".$dni."','".$nombre."','".$apellidos."','".$correo."','".$telefono."','".$fec_nacimiento."');";
              $consulta2=mysqli_query($conexion, $instruccion2) or die ("Fallo de la consulta");
              if ($consulta2) {
                print("<h2>!Te has registrado con exito!</h2>");
                print('<a href="../Inicio_sesion/inicio_sesion.php">Inicia sesión</a>');
              } else {
                Print ("<h2>Error al registrar!!!, vuelve atras y mete los datos bien </h2>");
                print("<a href='../Inicio_sesion/inicio_sesion.php'>Inicia seccion</a>");
              }
              mysqli_close($conexion);
            }
            else{
            ?>
              <form action="registro.php" method="post">
                <?php
                $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
                mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
                $instruccion="SELECT MAX(cod_cliente) AS ultimo_cod_cliente FROM Clientes";
                $consulta=mysqli_query($conexion, $instruccion) or die ("Fallo de la consulta");
                $registro = mysqli_fetch_assoc($consulta);
                $ultimo_cod_cliente = $registro['ultimo_cod_cliente'];
                mysqli_close($conexion);
                ?>
                <input type="hidden" name="cod_cliente" value="<?php echo $ultimo_cod_cliente; ?>">
                <fieldset>
                  <legend>Registrate</legend>
                  <div id="contenedor_form">
                    <div class="izquierda">
                      <label for="username">Username: </label>
                      <br>
                      <label for="password">Contraseña: </label>
                      <br>
                      <label for="dni">DNI: </label>
                      <br>
                      <label for="nombre">Nombre: </label>
                      <br>
                      <label for="apellidos">Apellidos: </label>
                      <br>
                      <label for="correo">Correo: </label>
                      <br>
                      <label for="fecha_nacimiento">Fecha_nac: </label>
                      <br>
                      <label for="telefono">Telefono: </label>
                      <br>
                      <label for="terminos">Aceptas lo terminos</label>
                    </div>
                    <div class="derecha">
                      <input type="text" name="username">
                      <br>
                      <input type="password" name="password">
                      <br>
                      <input type="text" name="dni">
                      <br>
                      <input type="text" name="nombre">
                      <br>
                      <input type="text" name="apellidos">
                      <br>
                      <input type="text" name="correo">
                      <br>
                      <input type="date" name="fecha_nacimiento" value="1995-05-01">
                      <br>
                      <input type="text" name="telefono">
                      <br>
                      <input type="checkbox" name="terminos" required>
                    </div>
                  </div>
                  <input type="submit" name="enviar" value="Registrar">
                </fieldset>
              </form>
            </div>
          </div>
          <?php
            }
            ?>
          <!--<div id="contenedor_boton_compra">
            <div id="boton">
              <a href="" target="_self"><p>Compra Entradas</p></a>
            </div>
          </div>-->
        </section>
        <footer id="final">
          <div id="redes">
            <div class="contenedor_redes"><a href="https://www.facebook.com/fabrikmadrid/?locale=es_ES" target="_blank"><img src="recursos/Facebook_icon.svg.png" id="facebook"></a></div>
            <div class="contenedor_redes"><a href="https://www.instagram.com/fabrikmadrid/?hl=es" target="_blank"><img src="recursos/instagram.jfif" id="instagram"></a></div>
            <div class="contenedor_redes"><a href="https://twitter.com/fabrikdiscoteca?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><img src="recursos/twitter.jpeg" id="twitter"></a></div>
            <div class="contenedor_redes"><a href="https://www.tiktok.com/@fabrikmadrid?lang=es" target="_blank"><img src="recursos/tiktok.png" id="tiktok"></a></div>
          </div>
          <div id="mensaje_final"><p id="mensaje1">¡Gracias por su visita!</p><p id="mensaje2">¡Disfruten de las fiestas!</p></div>
        </footer>
    </div>
</body>
</html>

