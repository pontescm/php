<?php

class Sql extends PDO { //faz os mesmos métodos do PDO bindParam(), prepare(), execute(), etc

	private $conn;

	public function __construct(){

		$dsn = "mysql:host=localhost;dbname=dbphp7";
		$usuarioBD = "root";
		$passBD = "bLB5tDUZW8Qj4GvFPRJu";

		$this->conn = new PDO($dsn,$usuarioBD,$passBD);

	}

	private function setParams($statment, $parameters = array()){ //para cada parametro amarra os valores a eles na query

		foreach ($parameters as $key => $value) {
		
			//$statment->setParam($key,$value);
			$statment->bindParam($key,$value);

		}

	}

	/*private function setParam($statment, $key, $value){ //ligação entre parametros e valores do vetor de valores

		$statment->bindParam($key,$value);

	}*/


	public function query ($rawQuery, $parameters = array()){ //$rawQuery é query comando $params sao parametros desse comando

		$statment = $this->conn->prepare($rawQuery);
		
		//$this->setParams($statment, $parameters);

		foreach ($parameters as $key => $value) {
		
			//$statment->setParam($key,$value);			
			$statment->bindParam($key,$value);
		}
		//var_dump($statment);
		//$statment->execute();
		if($statment->execute()){	
			echo "OK";		
		    //header('Location: Sql.php');
		}else{
		    echo 'Erro ao fazer query no banco';
		    print_r($statment->errorInfo());
		}		
		//var_dump($parameters);
		return $statment;	

	}

	public function select($rawQuery,$parameters = array()):array
	{ //retorna um array

		//$statment = $this->query($rawQuery,$parameters);
		
		//return $statment->fetchAll(PDO::FETCH_ASSOC);
		$statment = $this->conn->prepare($rawQuery);
		foreach ($parameters as $key => $value) {
		
			//$statment->setParam($key,$value);			
			$statment->bindParam($key, $value);

		}
		$statment->execute();
		//var_dump($statment);
		return $statment->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>