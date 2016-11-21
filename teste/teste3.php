<?php    include 'functions.inc2.php';
         $puxaBD = new Crud();
		 $puxaBD->conn();
		 $email = "teste2";
		 
		 
		 $id = rand(1005,2000);
		 
		 echo consoleLog("resposta id=$id iseriu?= ". $insert = $puxaBD->selectCustomQuery("insert into resposta (id) Values ($id)"));
		 $resp = array ();
		 for($x=1;$x<45;$x++){
			 $resp[$x] = rand(-2,2);
		 }
		 $retorno = $puxaBD->selectCustomQuery("Select id from resposta where id=$id order by id desc");
		 $linhaVal = $retorno->fetch_assoc();
		 $valID = $linhaVal["id"];
		 echo consoleLog("select no id $valID");
		 $retorno->free();
		 foreach($resp as $indice => $valor){
			echo ("$indice e $valor <br>");
		    echo consoleLog("responde o questionario $indice = ". $insert = $puxaBD->selectCustomQuery("insert into resp_quest (Questaoid, RespostaId, ValorResposta) values ($indice, $valID, $valor)"));	 
		 }
		
		
		calculaMediaFAtor($valID);
		calculaMediaSUBFAtor($valID);
		
		function calculaMediaFAtor ($ID){
			$puxaBD = new Crud();
		 $puxaBD->conn();
			$res = $puxaBD->selectCustomQuery("select q.fator, Sum(peso),Sum(rq.ValorResposta)'Soma das Respostas', Sum(rq.ValorResposta*q.Peso)/Sum(q.peso) 'Media Ponderada', AVG(valorResposta) 'Media', count(*) from resp_quest rq join questao q on q.id = rq.questaoid  where rq.RespostaID=$ID AND q.exibir=1 group by q.fator");
			$count = 1;
			echo ("Id  = $ID");
			echo ("<table>");
			while ($row = $res->fetch_assoc()){
				echo("<tr>");
				$size= 0;
				if($count == 1){
					foreach($row as $indice => $linha){
						echo ("<th> $indice      </th>");
						if (++$size == count($row)) 
							{ $size =0; echo ("</tr>");}				
					$count++;
					} 
				}	
				foreach($row as $indice => $linha){
					echo ("<td> $linha </td> ");
					//if (++$size == count($row))  echo "</td>";  
				}
				echo ("</tr>");
                                switch($row["fator"]){
                        case "A" : echo "<br>". $realizacao = $row["Media"]; break;
                        case "S" : echo "<br>".$social = $row["Media"]; break;
                        case "I" : echo "<br>".$imersao = $row["Media"]; break;
                    }
			}
			
			echo("</table>");
                        
                        
                              
                    
                
			$res->free();	
		}	
		function calculaMediaSUBFAtor ($ID){
			$puxaBD = new Crud();
		 $puxaBD->conn();
			$res = $puxaBD->selectCustomQuery("select q.subfator, Sum(peso),Sum(rq.ValorResposta)'Soma das Respostas', Sum(rq.ValorResposta*q.Peso)/Sum(q.peso) 'Media Ponderada', AVG(valorResposta) 'Media', count(*) from resp_quest rq join questao q on q.id = rq.questaoid  where rq.RespostaID=$ID AND q.exibir=1 group by q.subfator order by q.fator");
			$count = 1;
			echo ("Id  = $ID");
			echo ("<table>");
			while ($row = $res->fetch_assoc()){
				echo("<tr>");
				$size= 0;
				if($count == 1){
					foreach($row as $indice => $linha){
						echo ("<th> $indice      </th>");
						if (++$size == count($row)) 
							{ $size =0; echo ("</tr>");}				
					$count++;
					} 
				}	
				foreach($row as $indice => $linha){
					echo ("<td> $linha </td> ");
					//if (++$size == count($row))  echo "</td>";  
				}
				echo ("</tr>");
                                switch ($row["subfator"]) {
                        
                    //Realização
                            case "Avanço" :                           
                                echo "<br>".$avanco = $row["Media"];
                               break;
                            case "Mecanica" :
                                echo "<br>".$mecanica = $row["Media"];
                                break;
                            case "Competição" :
                                echo "<br>".$competicao = $row["Media"];
                                break;
                    //imersao
                            case "Descoberta" :
                               echo "<br>".$descoberta = $row["Media"];
                                break;
                            case "Role Playing" :
                                echo"<br>".$roleplaying = $row["Media"];
                                break;
                            case "Escapismo" :
                                echo"<br>".$escapismo = $row["Media"];
                                break;
                            case "Customização" :
                               echo "<br>".$customizacao = $row["Media"];
                                break;
                    //Social
                            case "Trabalho em equipe" :
                                echo "<br>".$trabalhoequipe = $row["Media"];
                                break;
                            case "Socialização" :
                                echo "<br>".$socializacao = $row["Media"];
                                break;
                            case "Relacionamento" :
                                echo "<br>". $relacionamento = $row["Media"];
                            break;                                                        
                    }
			}
			
			echo("</table>");
			$res->free();	
		}	
		
		/*
		$row = $res->fetch_assoc();*/
	//	echo ($row["id"]."  ". $row["email"]);
		
		
		
		
		echo consoleLog($puxaBD->close());
		
		
?>