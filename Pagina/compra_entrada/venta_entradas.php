<!DOCTYPE html>
<html lang="es">
    <!--Modelos-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="venta_entradas.css">
    <script src="https://kit.fontawesome.com/c9fb004c70.js" crossorigin="anonymous"></script>
    <title>Venta</title>
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
                <li id="user"><a href="inicio_sesion.html"><i class="fa-sharp fa-solid fa-bars"></i>&nbsp;Socios</a></li>
              </ul>
            </div>
          </nav>    
        <section id="cuerpo">
          <div id="contenedor_registro">
            <div id="formulario">
              <?php
              if(isset($_POST['sesion'])) {
                print("hola");
              }
              else {
                if(isset($_POST[''])){
                  $cod_cliente=$_POST['codigo_cliente'];
                  print("hola". $cod_cliente);
                  print("<br>");
                }
                $conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
                mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
                $instruccion="SELECT * FROM Fiestas";
                $consulta=mysqli_query($conexion, $instruccion) or die ("Fallo de la consulta");
                $nfilas = mysqli_num_rows($consulta);
              ?>
              <script>
                function fi_fabrik(){
                  var selectElement = document.getElementById("fiesta");
                  var selectedOption = selectElement.options[selectElement.selectedIndex];
                  var info_cod = '<?php
                   ?>';
                  document.getElementById("musica").value = info_cod;
                }
              </script>
              <form action="venta" method="post">
                <fieldset>
                  <legend>Entradas</legend>
                  <div id="contenedor_form">
                    <div class="izquierda">
                      <label for="fiesta">Fiesta </label>
                      <br>
                      <label for="musica">Musica</label>
                    </div>
                    <div class="derecha">
                      <select name="fiesta" id="fiesta" onChange="fi_fabrik()">
                        <?php
                        for ($i=0; $i < $nfilas; $i++){
                          $fila= mysqli_fetch_array ($consulta);
                          print("<option value='".$fila['cod_fiesta']."'>".$fila['nombre_fiesta']."</option>");
                        }
                        ?>
                        <br>
                      </select>
                      <br>
                      <input type="text" name="musica">
                    </div>
                  </div>
                  <input type="submit" name="enviar" value="Registrar">
                </fieldset>
              </form>
              <?php
              mysqli_close($conexion);
              }
              ?>
            </div>
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