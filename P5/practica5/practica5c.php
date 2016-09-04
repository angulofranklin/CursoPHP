<HTML LANG="es">

<HEAD>
   <TITLE>Generación de formularios desde PHP</TITLE>
</HEAD>

<BODY>

<H1>Generación de formularios desde PHP</H1>

<FORM ACTION="practica5c-resultados.php" METHOD="POST">

<P>Selecciona opción:

<?PHP
   $valores = array ("uno", "dos", "tres");
   $seleccionado = "dos";

   print ("<SELECT NAME='select'>\n");
   for ($i=0; $i<count($valores); $i++)
   {
      $cad = $valores[$i];
      if ($cad == $seleccionado)
         print ("<OPTION SELECTED>$cad\n");
      else
         print ("<OPTION>$cad\n");
   }
   print ("</SELECT>\n");
?>

</P>

<INPUT TYPE="SUBMIT" NAME="enviar" VALUE="seleccionar">
</FORM>

</BODY>
</HTML>
