<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			":ID"=>$id
		));

		//if (isset($results[0]))
		if (count($results) > 0){
			
			$row = $results[0];
			var_dump($results[0]);
			$this->setData($results[0]);
		}

		//echo "antes idusuario:".$this->getIdusuario()."<br>";
		//echo "antes deslogin:".$this->getDeslogin()."<br>";
		//echo "antes dessenha:".$this->getDessenha()."<br>";
	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	public static function search($login)
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login,$pass){
	//public function login($login){

		$sql = new Sql();

		$parametros = array(":LOGIN"=>$login,":PASSWORD"=>$pass);
		//$parametros = Array(":LOGIN"=>$login);
		//print_r($parametros);
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN  AND  dessenha = :PASSWORD",$parametros);
		//$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN",$parametros);

		//if (isset($results[0]))
		if (count($results) > 0){
			
			$row = $results[0];

			$this->setData($results[0]);			
		}
		else{
			throw new Exception("Login e/ou senha inválidos!");
		}

	}

	public function setData($data){
		//var_dump($data);
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);			
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results) > 0){	
		
			$this->setData($results[0]);			
		}
		else{
			throw new Exception("Não consegui inserir no banco de dados!");
		}

	}

	public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);
		//var_dump($this->getIdusuario());		
		$parametros = array(':LOGIN'=>$login,':PASSWORD'=>$password,':ID'=>$this->getIdusuario());
		//var_dump($parametros);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD  where idusuario = :ID",$parametros);
		//var_dump($sql);
		//$parametros = array(':LOGIN'=>$login,':PASSWORD'=>$password,':ID'=>$this->getIdusuario());
		/*$sql->query("UPDATE tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD where idusuario = :ID",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));*/
		
//		echo "<br>depois idusuario:".$this->getIdusuario()."<br>";
//		echo "depois deslogin:".$this->getDeslogin()."<br>";
//		echo "depois dessenha:".$this->getDessenha()."<br><br>";
		
		//$sql->query("CALL sp_usuarios_update(:LOGIN,:PASSWORD, :ID)",$parametros);
		

		/*if (count($results) > 0){	

		//var_dump($results[0]);
			$this->setData($results[0]);			
		}
		else{
			throw new Exception("Não consegui atualizar no banco de dados!");
		}*/
		/*$sql->query("update tb_usuarios SET deslogin = 'celio', dessenha = 'oilec' WHERE idusuario = :ID",array(			
			':ID'=>$this->getIdusuario()
		));*/
	}

	public function __construct($login = "",$pass = ""){
		$this->setDeslogin($login);
		$this->setDessenha($pass);
	}

	public function __toString()
	{
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()//->format("d/m/Y H:i:s")
		));

	}
}

?>