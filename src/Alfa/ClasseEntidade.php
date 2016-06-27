<?php
namespace Alfa;

use Alfa\BaseDeDados;

abstract class ClasseEntidade extends Entidade
{

  public $base;

  public function __construct(BaseDeDados $base)
  {
    $this->base = $base;
  }

  public function create($colunas, $valores)
  {

    $sql = "INSERT INTO $this->nome (".$colunas.") VALUES ('".implode("','",$valores)."')";

    if(!mysqli_query($this->base->conexao, $sql))
      throw new \Exception(mysqli_error($this->base->conexao));

    return  mysqli_insert_id($this->base->conexao);

  }

  public function retrieve($colunas, $clausula)
  {
    $sql = "SELECT $colunas FROM $this->nome WHERE id = $clausula";

    if(!$result = mysqli_query($this->base->conexao, $sql))
      throw new \Exception(mysqli_error($this->base->conexao));

    return mysqli_fetch_object($result);
  }

  public function update($colunas, $valores, $clausula)
  {
    $teste = null;
    $values = array_combine($colunas, $valores);
    foreach ($values as $key => $value) {
      $teste .= $key." = '".$value."', ";
    }
    $teste = substr_replace($teste, '', -2);

    $sql = "UPDATE $this->nome SET $teste WHERE id = $clausula";

    if(!$result = mysqli_query($this->base->conexao, $sql))
      throw new \Exception(mysqli_error($this->base->conexao));
  }

  public function delete($clausula)
  {
    $sql = "DELETE FROM $this->nome WHERE id = $clausula";

    if(!$result = mysqli_query($this->base->conexao, $sql))
      throw new \Exception(mysqli_error($this->base->conexao));


  }

}
