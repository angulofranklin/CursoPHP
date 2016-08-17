<?PHP
   header ("Content-type: image/png");

// Crear imagen
   $imagen = imagecreate (300, 300);
   $colorfondo = imagecolorallocate ($imagen, 203, 203, 203); // CCCCCC
   $colortexto = imagecolorallocate ($imagen, 0, 0, 0); // 000000

   imagefilledrectangle ($imagen, 0, 0, 300, 300, $colorfondo);

// Conectar con el servidor de base de datos
   $conexion = mysql_connect ("localhost", "Fab10tupapa123456", "")
      or die ("No se puede conectar con el servidor");

// Seleccionar base de datos
   mysql_select_db ("lindavista")
      or die ("No se puede seleccionar la base de datos");

// Calcular el número total de filas de la tabla
   $instruccion = "select * from viviendas";
   $consulta = mysql_query ($instruccion, $conexion)
      or die ("Fallo en la consulta");
   $nviviendas = mysql_num_rows ($consulta);

// Enviar consulta
   $instruccion = "select zona, count(*) from viviendas group by zona";
   $consulta = mysql_query ($instruccion, $conexion)
      or die ("Fallo en la consulta");

// Mostrar resultados de la consulta
   $nfilas = mysql_num_rows ($consulta);
   if ($nfilas > 0)
   {
      $anguloinicial = 0;
      $rojo = 0;
      $verde = 0;
      $azul = 51;
      for ($i=0; $i<$nfilas; $i++)
      {
         $resultado = mysql_fetch_array ($consulta);
         $zona = $resultado['zona'];
         $numero = $resultado['count(*)'];

         $porcentaje = round (($numero/$nviviendas)*100,2);
         $angulofinal = $anguloinicial + 3.6 * $porcentaje;
         $rojo = $rojo + 51;
         $verde = $verde + 51;
         $azul = $azul + 51;
         $color = imagecolorallocate ($imagen, $rojo, $verde, $azul);
         imagefilledarc ($imagen, 150, 120, 200, 200, $anguloinicial, $angulofinal, $color, IMG_ARC_PIE);
         $anguloinicial = $angulofinal;

         $y1=240+$i*12;
         $y2=$y1+10;
         imagefilledrectangle ($imagen, 60, $y1, 80, $y2, $color);
         $texto = $zona . ": " . $numero . " (" . $porcentaje . "%)";
         imagestring ($imagen, 3, 90, $y1, $texto, $colortexto);
      }
   }

// Cerrar conexión
   mysql_close ($conexion);

   imagepng ($imagen);
   imagedestroy ($imagen);
?>
