<?PHP
// Iniciar sesión
   session_start ();

// Obtener valores introducidos en el formulario
   $buscar = $_REQUEST['buscar'];
   $ndormitorios = $_REQUEST['ndormitorios'];
   $precio = $_REQUEST['precio'];

// Obtener valores almacenados en la sesión
   $tipo = $_SESSION['tipo'];
   $zona = $_SESSION['zona'];

   $error = false;
   if (isset($buscar))
   {

   // Comprobar errores
   // Número de dormitorios
      if (!is_numeric($ndormitorios))
      {
         $errores["ndormitorios"] = "Debe introducir un valor numérico";
      	 $error = true;
      }
      else
         $errores["ndormitorios"] = "";
   
   // Precio
      if (!is_numeric($precio))
      {
         $errores["precio"] = "Debe introducir un valor numérico";
      	 $error = true;
      }
      else
         $errores["precio"] = "";
   }

// Si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {
   // Almacenar variables en la sesión
      $_SESSION['ndormitorios'] = $ndormitorios;
      $_SESSION['precio'] = $precio;

   // Ir al siguiente paso
      header ("Location: busca_vivienda_4.php");
   }
   else
   {
?>

<HTML LANG="es">

<HEAD>
   <TITLE>Búsqueda de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

   <SCRIPT LANGUAGE='JavaScript'>
   <!--
      function cargaPagina (pagina)
      {
         window.location=pagina;
      }
   // -->
   </SCRIPT>

</HEAD>

<BODY>

<H1>Búsqueda de vivienda</H1>

<P CLASS="paso">1. Tipo > 2. Zona > <SPAN CLASS="pasoactual">3. Características</SPAN> > 4. Extras</P>

<H2>Paso 3: Elija las características básicas de la vivienda</H2>

<FORM CLASS="borde" ACTION="busca_vivienda_3.php" METHOD="POST">

<P><LABEL>Dormitorios:</LABEL>
<?PHP
   $default = 3;
   if (isset($buscar)) $default = $ndormitorios;
   if (isset($_SESSION['ndormitorios'])) $default = $_SESSION['ndormitorios'];
   for ($i=1; $i<=5;$i++)
      if ($i == $default)
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$i' CHECKED>$i\n");
      else
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$i'>$i\n");
?>
</P>

<P><LABEL>Precio (&euro;)</LABEL>
<?PHP
   $precios = array ("000100"=>"<100.000", "100200"=>"100.000-200.000",
                     "200300"=>"200.000-300.000", "300900"=>">300.000");
   $default = "200300";
   if (isset($buscar)) $default = $precio;
   if (isset($_SESSION['precio'])) $default = $_SESSION['precio'];
   foreach ($precios as $k => $v)
      if ($k == $default)
         print ("<INPUT TYPE='radio' NAME='precio' VALUE='$k' CHECKED>$v\n");
      else
         print ("<INPUT TYPE='radio' NAME='precio' VALUE='$k'>$v\n");
?>
</P>

<P><INPUT TYPE="BUTTON" VALUE="< Anterior" ONCLICK="cargaPagina('busca_vivienda_2.php')">
<INPUT TYPE="submit" NAME="buscar" VALUE="Siguiente >"></P>

</FORM>

<?PHP
// Mostrar datos recogidos
   print ("<P>Buscando $tipo en $zona</P>\n");

   }
?>

</BODY>
</HTML>