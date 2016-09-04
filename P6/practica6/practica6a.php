<HTML LANG="es">

<HEAD>
   <TITLE>Conversor de monedas</TITLE>
</HEAD>

<BODY>

<H1>Conversor de monedas</H1>

<?PHP
   $enviar = $_REQUEST['enviar'];
   if (isset($enviar))
   {
      $tablaconversion = array (
         "dólares" => 1.488,
         "libras"  => 0.747,
         "yenes"   => 158.339,
         "francos"   => 1.605
         );
      $euros = $_REQUEST['euros'];
      $moneda = $_REQUEST['moneda'];
      if ($euros == "")
         print ("<P>Debe introducir una cantidad</P>\n");
      else
      {
         $cantidad = $euros * $tablaconversion ["$moneda"];
         print ("<P>$euros euro(s) equivale(n) a $cantidad $moneda</P>\n");
      }

      print ("<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>\n");
   }
   else
   {
?>

<FORM ACTION="practica6a.php" METHOD="POST">

<P>Cantidad en euros:
<INPUT TYPE="TEXT" NAME="euros">
Convertir a:
<SELECT NAME="moneda">
   <OPTION VALUE="dólares" SELECTED>Dólares USA
   <OPTION VALUE="libras">Libras esterlinas
   <OPTION VALUE="yenes">Yenes japoneses
   <OPTION VALUE="francos">Francos suizos
</SELECT></P>

<INPUT TYPE="SUBMIT" NAME="enviar" VALUE="convertir">

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>
