<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 19/02/2018
 * Time: 19:49
 */

  ?>

  PROBANDO VISTAS

  <?php
  var_dump($_POST);
  var_dump($_GET);


  echo $usuario->getNombre() . "<br />";
  ?>
  <a href="<?php echo $this->url->get("encuestas/index"); ?>">encuestas</a>
