<?php
require ('../autoload.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Alfa\SGBD;
use Alfa\BaseDeDados;
use Alfa\Produto;
use Alfa\Entidade;

$servidor = new SGBD('mysql');
$servidor->setEndereco('localhost');
$servidor->setPorta(3366);
$servidor->setUsuario('root');
$servidor->setSenha('');

$base = new BaseDeDados($servidor);
$base->setNome('galvao_oo');

$produto = new Produto($base);

try {
  $base->conectar();
  $last_id = $produto->create('nome, preco', array('Esse trabalho vale 10', 10.00));
  echo "<pre>"; print_r($last_id);
  $result = $produto->retrieve('nome', 1);
  echo "<pre>"; print_r($result);

  $produto->update(['nome', 'preco'], ['Esse menino merece 10', '1200.00'], 1);

  $produto->delete(2);

} catch (Exception $e) {
  echo 'Error :'.$e->getMessage();
}

