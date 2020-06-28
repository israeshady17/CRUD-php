<?php 

$url = (isset($_GET['url'])) ? $_GET['url'] : null;

if (isset($url)) {
  switch ($url) {
    case "novo-contato":
      include "contato/cadastrar_contato.php";
    break;
    case "listar-contatos":
      include "contato/listar_contato.php";
    break;
    case "editar-contato":
      include "contato/editar_contato.php";
    break;
    case "deletar-contato":
      include "contato/deletar_contato.php";
    break;
    default:
      include "erros/404.php";
    break;
  }
} else {
  include "contato/listar_contato.php";
}