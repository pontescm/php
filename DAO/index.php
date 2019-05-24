<?php

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = 7");

echo json_encode($usuarios);
*/
/*
$root = new Usuario();

$root->loadById(3);

echo $root;
*/
//$lista = Usuario::getList();
//echo json_encode($lista);
//Carrega uma lista de usuarios buscando pelo LOGIN
//$busca = Usuario::search("lio");
//echo json_encode($busca);

//carrega um usuário dado seu login e senha
//$usuario = new Usuario();
//$usuario->login("celio");
//$usuario->login("celio","oilec");
//$usuario->loadById(1);
//echo $usuario;
//$aluno = new Usuario();

//insert - Criando um novo usuário
//$aluno = new Usuario("aluno2","@lun02");
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lun0");
//$aluno->insert();

//echo $aluno;

$professor = new Usuario();
$professor->loadById(2);
$professor->update("professor","12345");
//$professor->loadById(1);
//$professor->update("celio","oilec");
echo $professor;
?>