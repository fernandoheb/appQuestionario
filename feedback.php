<?php
	include '/functions.inc2.php';
	
	$puxaBD = new Crud();
	$puxaBD->conn();
	echo "loading...";
	if(!isset($_GET['tempo'])){exit();}
	/*	$DB_HOSTNAME = 'localhost';
		$DB_USERNAME = 'root';
		$DB_PASSWORD = 's3nh4r00t';
		$DB_DATABASE = 'brunopra_yee';
		$link=mysql_connect($DB_HOSTNAME,$DB_USERNAME,$DB_PASSWORD);
		$dbs = mysql_select_db($DB_DATABASE); */
		
	$id = @$_GET['id'];
	$tempo = @$_GET['tempo'];
	$tempod = @$_GET['tempodetalhes'];
	$graf1 = @$_GET['graf1'];
	$graf2 = @$_GET['graf2'];
	$graf3 = @$_GET['graf3'];
	$totaldetalhes = @$_GET['totaldetalhes'];
	$detalhesabertos = @$_GET['detalhesabertos'];
	$detalhesabertos--;
	$aux = $detalhesabertos."/".$totaldetalhes;
	echo $aux;

	$sql = "insert into feedback (id,tempo,graf1,graf2,graf3,tempodetalhes,detalhesabertos) values ($id,$tempo,$graf1,$graf2,$graf3,$tempod,'$aux')";
	//$result = mysql_query($sql);
	$result = $puxaBD->selectCustomQuery($sql);
?>
