<?php
/**
 * Class RequirePage
 * Classe qui sert a redirectionner ou include des Vues 
 *
 *
 * @author Valentina Ionescu
 * @version 1.0
 *
 */

class RequirePage
{

  public static function getView($path, $data = [])
  {
    extract($data, EXTR_SKIP);
    if (file_exists("./vues/" . $path . '.php')) {
      include './vues/' . $path . '.php';
    }
  }
  public static function getPage($path, $data = [])
  {
    extract($data, EXTR_SKIP);
    if (file_exists("./" . $path )) {
      include './' . $path ;
    }
  }

  static public function redirect($url, $data = [])// l"url complet
  {
    extract($data, EXTR_SKIP);
    header("Location: $url");
    exit;
  }
  
}
