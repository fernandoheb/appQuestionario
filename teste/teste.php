<?php include 'functions.inc.php';
// include 'connect.php';
 
        $DB_HOSTNAME = 'localhost';
		$DB_USERNAME = 'root';
		$DB_PASSWORD = '';
		$DB_DATABASE = 'brunopra_yee';

	/*	function consoleLog($texto) {
			return "<script> console.log('$texto'); </script>";
		}
		*/
		function novaConexao($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE){
			 $conn = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

			if(mysqli_connect_errno()) {

				echo nl2br("Error: Could not connect to database " . mysqli_connect_error() . "\n\n"); //echo + \n need nl2br function
				
				echo "Erro: Não foi possível conectar com o banco de dados " . mysqli_connect_error();

				exit;

			} else { echo consoleLog("connected");
			 		 return $conn;
					 }
		}	
		$conn = novaConexao($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
	//Imprime  todos os valores 
	/*
 	 $res = mysqli_query($conn,"Select * from resposta where genero ='m' order by id asc");
				$resposta_id = mysqli_num_rows($res);
		echo "<br> $resposta_id <br> <BR>  ";
		
		while ($row = $res->fetch_assoc()){
			$size= 0;
			if($row["id"] == 1)
				foreach($row as $indice => $linha){
				echo ("$indice      ");
					if (++$size == count($row)) { echo "<br>"; $size =0;} 
			}
			foreach($row as $indice => $linha){
				echo ("$linha   ");
				if (++$size == count($row))  echo "<br>";  
			}
		}
		$res->free();	
		*/
		$email = "teste2";
		echo consoleLog($insert = $conn->query("insert into resposta (email) values ('$email')"));
		$res = $conn->query("select id, email from resposta where email='$email'");
		$row = $res->fetch_assoc();
		echo ($row["id"]."  ". $row["email"]);
		$res->free();
		
		
		
		echo consoleLog($conn->close());
		
		
?>