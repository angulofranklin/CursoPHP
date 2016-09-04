<HTML LANG="es">

<HEAD>
   <TITLE>Subida de ficheros</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<?PHP
// Si se ha enviado el formulario
   if (isset($_REQUEST['enviar']))
   {
   // Mostrar noticia
?>

<H1>Subida de ficheros. Resultados del formulario</H1>

<H2>Resultado de la inserción de nueva noticia</H2>

<?PHP

   // Obtener valores introducidos en el formulario
      $titulo = $_REQUEST['titulo'];
      $texto = $_REQUEST['texto'];
      $categoria = $_REQUEST['categoria'];

   // Comprobar que se han introducido todos los datos obligatorios
      $errores = "";
      if (trim($titulo) == "")
         $errores = $errores . "   <LI>Se requiere el título de la noticia\n";
      if (trim($texto) == "")
         $errores = $errores . "   <LI>Se requiere el texto de la noticia\n";

   // Subir fichero
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
      }
   // El fichero introducido supera el límite de tamaño permitido
      else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores = $errores . "   <LI>El tamaño del fichero supera el límite permitido ($maxsize bytes)\n";
      }
   // No se ha introducido ningún fichero
      else if ($_FILES['imagen']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
         $errores = $errores . "   <LI>No se ha podido subir el fichero\n";

   // Mostrar errores encontrados
      if ($errores != "")
      {
         print ("<P>No se ha podido realizar la inserción debido a los siguientes errores:</P>\n");
         print ("<UL>\n");
         print ($errores);
         print ("</UL>\n");
         print ("<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>\n");
      }
      else
      {

      // Aquí vendría la inserción de la noticia en la Base de Datos

      // Mover fichero de imagen a su ubicación definitiva
         if ($copiarFichero)
            move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombreDirectorio . $nombreFichero);

      // Mostrar datos introducidos
         print ("<P>La noticia ha sido recibida correctamente:</P>\n");
         print ("<UL>\n");
         print ("   <LI>Título: $titulo\n");
         print ("   <LI>Texto: $texto\n");
         print ("   <LI>Categoría: $categoria\n");
         if ($copiarFichero)
            print ("   <LI>Imagen: <A TARGET='_blank' HREF='" . $nombreDirectorio . $nombreFichero . "'>" . $nombreFichero . "</A>\n");
         else
            print ("   <LI>Imagen: (no hay)\n");
         print ("</UL>\n");

         print ("<P>[ <A HREF='ejercicio4.php'>Insertar otra noticia</A> ]</P>\n");
      }
   }
   else
   {
   // Introducir noticia
?>

<H1>Subida de ficheros</H1>

<H2>Insertar nueva noticia</H2>

<FORM CLASS="borde" ACTION="ejercicio4.php" METHOD="POST" ENCTYPE="multipart/form-data">

<!-- Título de la noticia -->
<P><LABEL>Título: *</LABEL>
<INPUT TYPE="TEXT" NAME="titulo" SIZE="50" MAXLENGTH="50"></P>

<!-- Texto de la noticia-->
<P><LABEL>Texto: *</LABEL>
<TEXTAREA COLS="45" ROWS="5" NAME="texto"></TEXTAREA></P>

<!-- Categoría de la noticia-->
<P><LABEL>Categoría:</LABEL>
<SELECT NAME="categoria">
   <OPTION SELECTED>promociones
   <OPTION>ofertas
   <OPTION>costas
</SELECT></P>

<!-- Imagen asociada a la noticia.  Tamaño máximo: 100 Kb -->
<P><LABEL>Imagen:</LABEL>
<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="102400">
<INPUT TYPE="FILE" SIZE="44" NAME="imagen"></P>

<!-- Botón de envío -->
<P><INPUT TYPE="SUBMIT" NAME="enviar" VALUE="Insertar noticia"></P>

</FORM>

<P>NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</P>

<?PHP
   }
?>

</BODY>
</HTML>
