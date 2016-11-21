<?php include 'functions.inc.php';
         $puxaBD = new Crud();
		 $puxaBD->conn();
		 $email = "teste2";
		// echo consoleLog("insert ".$insert = $puxaBD->selectCustomQuery("insert into resposta (email) values ('$email')"));
		 
         $res = $puxaBD->selectCustomQuery("Select * from resposta where email = '$email'");
		 $res;
		 $row = $res->fetch_assoc();
		 $idnext = $row["id"];
		 echo consoleLog($idnext);

		
		
		/*$res = $conn->query("select id, email from resposta where email='$email'");
		$row = $res->fetch_assoc();*/
		echo ($row["id"]."  ". $row["email"]);
		$res->free();
		
		
		
		echo consoleLog($puxaBD->close());
		
		
?>