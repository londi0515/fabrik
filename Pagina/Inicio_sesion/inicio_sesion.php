<!DOCTYPE html>
<html lang="es">
    <!--Modelos-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="inicio_sesion.css">
    <script src="https://kit.fontawesome.com/c9fb004c70.js" crossorigin="anonymous"></script>
    <title>USER</title>
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
                <li id="user"><a href="inicio_sesion.php"><i class="fa-sharp fa-solid fa-bars"></i>&nbsp;Socios</a></li>
              </ul>
            </div>
          </nav>    
        <section id="cuerpo">
          <h1 id="titulo">Entradas</h1>
          <div id="contenedor_inicio_sesion">
            <?php
            if(isset($_POST['sesion'])) {
              $usuario = $_POST['nombre'];
              $password = $_POST['password'];
              $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
              mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
              $instruccion="SELECT * FROM clientes  WHERE username='".$usuario."' and password='".$password."';";
              $consulta=mysqli_query($conexion, $instruccion) or die ("Fallo de la consulta");
              $resultado=mysqli_num_rows($consulta);
              $registro = mysqli_fetch_assoc($consulta);
              $cod_cliente = $registro['cod_cliente'];
              if ($resultado == 1) {
                ?>
                <form accion='inicio_sesion.php' method='post' name='decision'>
                  <input type='hidden' name="codigo_cliente" value='<?php $cod_cliente ?>'>
                  <input type="submit" name="compra" value="Comprar entrada" class="boton">
                </form>
                <?php
              } 
              else {
                Print("<h2>Usuario o contraseña incorrecta</h2>");
                sleep(5);
                header("Location: inicio_sesion.php");
                
              }
              mysqli_close($conexion);
            }
            elseif(isset($_POST['compra'])){
                $codigo_cliente=$_POST['codigo_cliente'];
                $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
                mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
                $instruccion="SELECT * FROM Fiestas";
                $consulta=mysqli_query($conexion, $instruccion) or die ("Fallo de la consulta");
                $nfilas = mysqli_num_rows($consulta);
            ?>     
                <form action="inicio_sesion.php" method="post">
                <fieldset>
                  <legend>Entradas</legend>
                    <div class="con_form">
                      <label for="fiesta">Fiesta:</label>
                    </div>
                    <div class="con_form">
                      <select name="fiesta" id="select_fiesta" onChange="mostrarMusica()">
                        <?php
                        while ($fila = mysqli_fetch_array($consulta)) {
                          echo "<option value='".$fila['cod_fiesta']."'>".$fila['nombre_fiesta']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="con_form">
                      <label for="musica">Música</label>
                    </div>
                    <div class="con_form">
                      <input type="text" name="musica" id="musica" value="<?php echo $fila['musica']; ?>">
                    </div>
                    <div class="con_form">
                      <label for="fecha">Fecha</label>
                    </div>
                    <div class="con_form">
                      <input type="date" name="fecha" id="fecha" value="<?php echo $fila['fecha']; ?>">
                    </div>
                    <div class="con_form">
                      <label for="hora">Hora</label>
                    </div>
                    <div class="con_form">
                      <input type="time" name="hora" id="hora" value="<?php echo $fila['hora']; ?>">
                    </div>
                    <div class="con_form">
                      <label for="lugar">Lugar</label>
                    </div>
                    <div class="con_form">
                      <input type="text" name="lugar" id="lugar" value="<?php echo $fila['lugar']; ?>">
                    </div>
                    <div class="con_form">
                      <input type="submit" name="entrada" value="Comprar">
                    </div>
                    
                  </fieldset>

                  <script>
                    function mostrarMusica() {
                      var selectElement = document.getElementById("select_fiesta");
                      var selectedOption = selectElement.options[selectElement.selectedIndex].value;
                      <?php
                      mysqli_data_seek($consulta, 0);

                      while ($fila = mysqli_fetch_array($consulta)) {
                        echo "if (selectedOption === '".$fila['cod_fiesta']."') {
                                document.getElementById('musica').value = '".$fila['musica']."';
                                document.getElementById('fecha').value = '".$fila['fecha']."';
                                document.getElementById('hora').value = '".$fila['hora']."';
                                document.getElementById('lugar').value = '".$fila['lugar']."';
                              }";
                      }
                      ?>
                    }
                  </script>
              <?php

              mysqli_close($conexion);
            }
            elseif(isset($_POST['entrada'])){
              
              $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
              mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
              
              mysqli_close($conexion);
            }
            else {
            ?>
            <div id="formulario">
              <form action="inicio_sesion.php" method="post">
                <fieldset>
                  <legend>Login</legend>
                  <div class="con_form">
                    <label for="nombre">Username:</label>
                  </div>
                  <div class="con_form">
                    <input type="text" name="nombre" id="nombre">
                  </div>
                  <div class="con_form">
                    <label for="password">Password:</label>
                  </div>
                  <div class="con_form">
                    <input type="password" name="password" id="password">
                  </div>
                  <div class="con_form">
                    <input type="submit" name="sesion" value="Iniciar_sesion">
                  </div>
                </fieldset>
                <br>
                <div id="mensaje_form">
                  <p>
                    Si no estas registrado, <a href="../registro/registro.php">registrate</a> y unete a nuestra gran familia.
                    <br>
                    Para comprar entradas y tener fabulosos descuentos.
                  </p>
                </div>
              </form>
            </div>
            <?php
            }
            ?>
          </div>
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