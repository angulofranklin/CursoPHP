<?PHP
// -----------------------------------------------------------------
// Función que obtiene la extensión de un fichero
// -----------------------------------------------------------------
   function calcula_extension ($nombreFichero)
   {
      $extension = stristr ($nombreFichero, '.');
      $extension = ltrim ($extension, '.');
      $extension = strtoupper ($extension);
      return ($extension);
   }

// -----------------------------------------------------------------
// Función que obtiene el tipo de un fichero a partir de su extensión
// -----------------------------------------------------------------
   function tipo_fichero ($extension)
   {
      if ($extension == 'PDF')
         $tipo = 'Documento Adobe PDF';
      else if ($extension == 'TXT')
         $tipo = 'Documento de texto';
      else if ($extension == 'HTML' || $extension == 'HTM')
         $tipo = 'Documento HTML';
      else if ($extension == 'PPT')
         $tipo = 'Presentación Microsoft Powerpoint';
      else if ($extension == 'DOC')
         $tipo = 'Documento Microsoft Word';
      else if ($extension == 'GIF')
         $tipo = 'Imagen GIF';
      else if ($extension == 'JPG')
         $tipo = 'Imagen JPG';
      else if ($extension == 'ZIP')
         $tipo = 'Archivo comprimido ZIP';
      else
         $tipo = "Archivo " . $extension;
      return ($tipo);
   }
?>
