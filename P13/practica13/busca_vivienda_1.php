<?PHP
// Iniciar sesión
   session_start ();

// Obtener valores introducidos en el formulario
   $buscar = $_REQUEST['buscar'];
   $tipo = $_REQUEST['tipo'];

   $error = false;
   if (isset($buscar))
   {

   // Comprobar errores
   // Tipo
      if ($tipo == "Seleccione:")
      {
         $errores["tipo"] = "Debe seleccionar un tipo de vivienda";
      	 $error = true;
      }
      else
         $errores["tipo"] = "";
   }
   
// Si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {
   // Almacenar variable en la sesión
      $_SESSION['tipo'] = $tipo;

   // Ir al siguiente paso
      header ("Location: busca_vivienda_2.php");
   }
   else
   {
?>

<HTML LANG="es">

<HEAD>
   <TITLE>Búsqueda de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Búsqueda de vivienda</H1>

<P CLASS="paso"><SPAN CLASS="pasoactual">1. Tipo</SPAN> > 2. Zona > 3. Características > 4. Extras</P>

<H2>Paso 1: Elija el tipo de vivienda</H2>

<FORM CLASS="borde" ACTION="busca_vivienda_1.php" METHOD="POST">

<P><LABEL>Tipo:</LABEL>
<SELECT NAME="tipo">
<?PHP
   $tipos = array ("Seleccione:", "Piso", "Adosado", "Chalet", "Casa");
   $default ="Seleccione:";
   if (isset($buscar)) $default = $tipo;
   if (isset($_SESSION['tipo'])) $default = $_SESSION['tipo'];
   foreach ($tipos as $t)
      if ($t == $default) 
         print ("<OPTION VALUE='$t' SELECTED>$t\n");
      else  
         print ("<OPTION VALUE='$t'>$t\n");
   print ("</SELECT>\n");
   if ($errores["tipo"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["tipo"] . "</SPAN>");
?>
</P>

<P><INPUT TYPE="submit" NAME="buscar" VALUE="Siguiente >"></P>

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>