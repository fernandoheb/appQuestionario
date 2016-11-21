<?php
	include 'functions.inc.php';
	$puxaBD = new Crud();
	$puxaBD->conn();
?>

<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="pt-Br">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
	    <style>
	          .fb-share-button
		{
		transform: scale(1.5);
		-ms-transform: scale(1.5);
		-webkit-transform: scale(1.5);
		-o-transform: scale(1.5);
		-moz-transform: scale(1.5);

		}
	        </style>

	<?php
			$aux = $_GET["id"];
		  	$avanco =          $_GET["avc"];
			$competicao=       $_GET["cpc"];
			$mecanica=         $_GET["mca"];
			$socializacao=     $_GET["scz"];
			$relacionamento=   $_GET["rlc"];
			$trabalhoemequipe= $_GET["tbe"];
			$descoberta=       $_GET["dsc"];
			$roleplaying=      $_GET["rpg"];
			$customizacao=     $_GET["ctz"];
			$escapismo=        $_GET["ecp"];
                        $flag_resposta=    $_GET["resp"];



                        $maiorValor = max($avanco, $escapismo,  $socializacao, $competicao, $customizacao,  $relacionamento, $mecanica, $roleplaying, $trabalhoemequipe, $descoberta);
			$arrayNomeFatores = array("Avanco", "Escapismo", "Socializacao", "Competicao", "Customizacao", "Relacionamento", "Mecanica", "Roleplaying", "Trabalhoequipe", "Descoberta");
			$arrayFatores = array($avanco, $escapismo,  $socializacao, $competicao, $customizacao,  $relacionamento, $mecanica, $roleplaying, $trabalhoemequipe, $descoberta);


			$url = "http://200.144.255.42:8003/questionario/resultado3.php?id=".$aux."&avc=".$avanco."&cpc=".$competicao."&mca=".$mecanica."&scz=".$socializacao."&rlc=".$relacionamento."&tbe=".$trabalhoemequipe."&dsc=".$descoberta."&rpg=".$roleplaying."&ctz=".$customizacao."&ecp=".$escapismo."&resp=0";

	 		$i = 0;
			$s = 0;
			$j = 0;
			$nomes="";
			foreach ($arrayNomeFatores as $value){

					$customQuery='SELECT  `descricao`, `nomeFantasia` FROM `subfator` WHERE id = '.$i.'+1';
					$query2 = $puxaBD->selectCustomQuery($customQuery);
					$queryLP = $query2->fetch_assoc();

					$descricao = $queryLP["descricao"];
					$nomeFantasia = $queryLP["nomeFantasia"];

					$explic[$s]=$descricao;
					$s = $s+1;
					$i = $i + 1;
			}


			$avanco = str_replace(",", ".", $avanco);

			$escapismo = str_replace(",", ".", $escapismo);

			$socializacao = str_replace(",", ".", $socializacao);

			$competicao = str_replace(",", ".", $competicao);

			$customizacao = str_replace(",", ".", $customizacao);

			$relacionamento = str_replace(",", ".", $relacionamento);

			$mecanica = str_replace(",", ".", $mecanica);

			$roleplaying = str_replace(",", ".", $roleplaying);

			$trabalhoemequipe = str_replace(",", ".", $trabalhoemequipe);

			$descoberta = str_replace(",", ".", $descoberta);

			$macroRealizacao = ($avanco + $mecanica + $competicao);
			$macroSocial = ($relacionamento +$socializacao + $trabalhoequipe);
			$macroImersao = ($customizacao + $escapismo + $descoberta + $roleplaying);

			if ($macroRealizacao<0){
				$macroRealizacao=0;
			}
			if ($macroSocial<0){
				$macroSocial=0;
			}
			if ($macroImersao<0){
				$macroImersao=0;
			}

			$positivos = 0;
			$i = 0;
			while ($i<10){
				if (str_replace(",", ".", $arrayFatores[$i]) > 0){
					$positivos = $positivos + str_replace(",", ".", $arrayFatores[$i]);
				}
				$i++;
			}
			$maiorValor = str_replace(",", ".", $maiorValor);



  ?>




  		<?php
		/*
	//Set the Image source variables
	$backgroundSource = "http://www.64bitjungle.com/wp-content/themes/openbook22-en/images/rss-subscribe.jpg";
	$feedBurnerStatsSource = "http://feeds2.feedburner.com/~fc/64BitJungle?bg=151515&fg=ffffff&anim=0";
	//Create new images
	$outputImage = imagecreatefromjpeg($backgroundSource);
	$feedBurnerStats = imagecreatefromgif($feedBurnerStatsSource);
	//Grab width and height of the FeedBurner image
	$feedBurnerStatsX = imagesx($feedBurnerStats);
	$feedBurnerStatsY = imagesy($feedBurnerStats);
	//Merge the two images
	imagecopymerge($outputImage,$feedBurnerStats,156,50,0,0,$feedBurnerStatsX,$feedBurnerStatsY,100);
	//Output header
	header('Content-type: image/png');
	//send new image to browser
	imagepng($outputImage);
	imagedestroy($outputImage);
	*/
?>
  <style>
      .effect6
{
  	position:relative;
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
       -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.effect6:before, .effect6:after
{
	content:"";
    position:absolute;
    z-index:-1;
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
    box-shadow:0 0 20px rgba(0,0,0,0.8);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    -moz-border-radius:100px / 10px;
    border-radius:100px / 10px;
}
.effect6:after
{
	right:10px;
    left:auto;
    -webkit-transform:skew(8deg) rotate(3deg);
       -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
         -o-transform:skew(8deg) rotate(3deg);
            transform:skew(8deg) rotate(3deg);
}
.box {
	background:#FFF;
}
  </style>



	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart", "bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

      	<?php
      	$arrayNomeFatores = array("Avanco", "Escapismo", "Socializacao", "Competicao", "Customizacao", "Relacionamento", "Mecanica", "Roleplaying", "Trabalho em equipe", "Descoberta");
	$arrayFatores = array($avanco, $escapismo,  $socializacao, $competicao, $customizacao,  $relacionamento, $mecanica, $roleplaying, $trabalhoemequipe, $descoberta);
	$explicacao = array($explic[0],$explic[1],$explic[2],$explic[3],$explic[4],$explic[5],$explic[6],$explic[7],$explic[8],$explic[9]);
      	?>

      	if (<?php echo $flag_resposta; ?> == 1){
		{document.getElementById("b3").style.display="none";}
	}
	var i;
	for (i=0; i<10;i++){
		{document.getElementById("exp"+i).style.display="none";}
	}

      	var jarrayNomeFatores= <?php echo json_encode($arrayNomeFatores); ?>;
      	var jarrayFatores = <?php echo json_encode($arrayFatores); ?>;
      	var descr = <?php echo json_encode($explicacao); ?>;

		var macroRealizacao = <?php echo $macroRealizacao; ?>;
		var macroSocial = <?php echo $macroSocial; ?>;
		var macroImersao = <?php echo $macroImersao; ?>;



      	for (i=0; i<10; i++){
      		jarrayFatores[i] = Number(jarrayFatores[i].replace(",","."));
      		if (jarrayFatores[i]<0){
      			jarrayFatores[i]=0;
      		}
      	}

        var data = google.visualization.arrayToDataTable([
          ['Fator', 'Relevancia'],
          [jarrayNomeFatores[0],    jarrayFatores[0] ],
          [jarrayNomeFatores[1],    jarrayFatores[1] ],
          [jarrayNomeFatores[2],    jarrayFatores[2] ],
          [jarrayNomeFatores[3],    jarrayFatores[3] ],
          [jarrayNomeFatores[4],    jarrayFatores[4] ],
          [jarrayNomeFatores[5],    jarrayFatores[5] ],
          [jarrayNomeFatores[6],    jarrayFatores[6] ],
          [jarrayNomeFatores[7],    jarrayFatores[7] ],
          [jarrayNomeFatores[8],    jarrayFatores[8] ],
          [jarrayNomeFatores[9],    jarrayFatores[9] ]
        ]);

        var options = {
          title: 'Principais fatores',
          backgroundColor: '#FAFAFA'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

		 var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        function selectHandler() {
        for (i=0; i<10;i++){
		{document.getElementById("exp"+i).style.display="none";}
	}
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            i = 0;
            var topping = data.getValue(selectedItem.row, 0);
            while (topping!=jarrayNomeFatores[i]){
            	i++;
            }
            {document.getElementById("exp"+i).style.display="block";}
          }
        }

        google.visualization.events.addListener(chart, 'select', selectHandler);


		chart.draw(data, options);

		 var data2 = google.visualization.arrayToDataTable([
          ['Fator', 'Relevancia'],
          ['Realização',    macroRealizacao ],
          ['Social',    macroSocial ],
          ['Imersão',    macroImersao ]
        ]);
        chart2.draw(data2, options);

		$(window).resize(function(){
		  drawChart();
		});

      }
    </script>

     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.setOnLoadCallback(drawStuff);

      function drawStuff() {
        <?php
      	$arrayNomeFatores = array("Avanco", "Escapismo", "Socializacao", "Competicao", "Customizacao", "Relacionamento", "Mecanica", "Roleplaying", "Trabalho em Equipe", "Descoberta");
	$arrayFatores =array($avanco, $escapismo,  $socializacao, $competicao, $customizacao,  $relacionamento, $mecanica, $roleplaying, $trabalhoemequipe, $descoberta);
      	?>
      	var jarrayNomeFatores= <?php echo json_encode($arrayNomeFatores ); ?>;
      	var jarrayFatores = <?php echo json_encode($arrayFatores); ?>;

      	var i;

      	for (i=0; i<10;i++){
		{document.getElementById("expbar"+i).style.display="none";}
	}

      	for (i=0; i<10; i++){
      		jarrayFatores[i] = Number(jarrayFatores[i].replace(",","."));
      	}

        var data = google.visualization.arrayToDataTable([
          ['Fator', 'Relevancia'],
          [jarrayNomeFatores[0],    jarrayFatores[0] ],
          [jarrayNomeFatores[1],    jarrayFatores[1] ],
          [jarrayNomeFatores[2],    jarrayFatores[2] ],
          [jarrayNomeFatores[3],    jarrayFatores[3] ],
          [jarrayNomeFatores[4],    jarrayFatores[4] ],
          [jarrayNomeFatores[5],    jarrayFatores[5] ],
          [jarrayNomeFatores[6],    jarrayFatores[6] ],
          [jarrayNomeFatores[7],    jarrayFatores[7] ],
          [jarrayNomeFatores[8],    jarrayFatores[8] ],
          [jarrayNomeFatores[9],    jarrayFatores[9] ]
        ]);

        var options = {
          title: 'Todos Fatores',
          legend: { position: 'none' },
          backgroundColor: '#FAFAFA',
		  color:  '#FAFAFA',
          axes: {
            x: {
              0: { side: 'top', label: 'Todos Fatores'} // Top x-axis.
            }
          }
          };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));


         function selectHandler() {
        for (i=0; i<10;i++){
		{document.getElementById("expbar"+i).style.display="none";}
	}
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            i = 0;
            var topping = data.getValue(selectedItem.row, 0);
            while (topping!=jarrayNomeFatores[i]){
            	i++;
            }
            {document.getElementById("expbar"+i).style.display="block";}
          }
        }

        google.visualization.events.addListener(chart, 'select', selectHandler);




        chart.draw(data, options);

		$(window).resize(function(){
		  drawStuff();
		});
      };
    </script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="assets/js/RGraph.common.core.js"></script>
<script src="assets/js/RGraph.radar.js"></script>
<script src="assets/js/RGraph.common.dynamic.js"></script>
<script src="assets/js/RGraph.common.key.js"></script>
<script src="assets/js/RGraph.drawing.rect.js"></script>
<script src="assets/js/RGraph.common.tooltips.js"></script>
<script src="assets/js/RGraph.common.effects.js"></script>


<script>
    $(document).ready(function ()
    {
			var jarrayNomeFatores= <?php echo json_encode($arrayNomeFatores ); ?>;
      	var jarrayFatores = <?php echo json_encode($arrayFatores); ?>;

      	var i;

      	for (i=0; i<10; i++){
      		jarrayFatores[i] = Number(jarrayFatores[i].replace(",","."));

			if (jarrayFatores[i]<=0){
				jarrayFatores[i]=0.01;
			}
      	}
        var radar = new RGraph.Radar({
            id: 'cvs',
			data: [[jarrayFatores[0],jarrayFatores[3],jarrayFatores[6],0.01,0.01,0.01,0.01,0.01,0.01,0.01],[0.01,0.01,0.01,jarrayFatores[5],jarrayFatores[2],jarrayFatores[8],0.01,0.01,0.01,0.01],[0.01,0.01,0.01,0.01,0.01,0.01,jarrayFatores[4],jarrayFatores[1],jarrayFatores[9],jarrayFatores[7]]],
            options: {
				tooltips: [
                               jarrayNomeFatores[0],jarrayNomeFatores[3],jarrayNomeFatores[6],jarrayNomeFatores[5],jarrayNomeFatores[2],jarrayNomeFatores[8],jarrayNomeFatores[4],jarrayNomeFatores[1],jarrayNomeFatores[9],jarrayNomeFatores[7],
							   jarrayNomeFatores[0],jarrayNomeFatores[3],jarrayNomeFatores[6],jarrayNomeFatores[5],jarrayNomeFatores[2],jarrayNomeFatores[8],jarrayNomeFatores[4],jarrayNomeFatores[1],jarrayNomeFatores[9],jarrayNomeFatores[7],
							   jarrayNomeFatores[0],jarrayNomeFatores[3],jarrayNomeFatores[6],jarrayNomeFatores[5],jarrayNomeFatores[2],jarrayNomeFatores[8],jarrayNomeFatores[4],jarrayNomeFatores[1],jarrayNomeFatores[9],jarrayNomeFatores[7]
                              ],
							   background: {
                        circles: {
                            poly: {
                                self: true,
                                spacing: 30
                            }
                        }
                    },
                    colors: ['Gradient(white:red)','Gradient(white:black)','Gradient(white:blue)'],
                    axes: {
                        color: 'transparent'
                    },
				  highlights: true,
                strokestyle: ['red', 'black','blue'],
                linewidth: 3,
                key: {
				//	self: [jarrayNomeFatores[0],jarrayNomeFatores[3],jarrayNomeFatores[6],jarrayNomeFatores[5],jarrayNomeFatores[2],jarrayNomeFatores[8],jarrayNomeFatores[4],jarrayNomeFatores[1],jarrayNomeFatores[9],jarrayNomeFatores[7]]
                    self: ['Realização','Social','Imersão'],
                    colors: ['red', 'black','blue'],
                    interactive: true
                }
         //       labels: [jarrayNomeFatores[0],jarrayNomeFatores[3],jarrayNomeFatores[6],jarrayNomeFatores[5],jarrayNomeFatores[2],jarrayNomeFatores[8],jarrayNomeFatores[4],jarrayNomeFatores[1],jarrayNomeFatores[9],jarrayNomeFatores[7]]
            }
        }).grow()
    });
</script>

<?php
            $i = 0;
			$s = 0;
			$j = 0;
			$teste = 0;
			foreach ($arrayNomeFatores as $value){
			$arrayFatores[$i] = str_replace(",", ".", $arrayFatores[$i]);
					$teste = $arrayFatores[$i]/$positivos;
				$teste = ($maiorValor/$positivos)-$teste;
				if ($teste <= 0.05) {
					$customQuery='SELECT  `descricao`, `nomeFantasia` FROM `subfator` WHERE id = '.$i.'+1';
					$query2 = $puxaBD->selectCustomQuery($customQuery);
					$queryLP = $query2->fetch_assoc();
					$nomeFantasia = $queryLP["nomeFantasia"];
					$nomesarray[$s]=utf8_encode($nomeFantasia);
					$s++;
				}
			$i = $i + 1;
			}
?>


		<title>Questionário do jogador</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<meta property="og:title" content="Meu perfil de jogador é:" />
		<meta property="og:url" content="<?php echo $url;?>" />
		<meta property="og:image" content="http://200.144.255.42:8003/questionario/imgChamada.png" />
		<meta property="og:image:width" content="910"/>
		<meta property="og:image:height" content="997"/>
		<meta property="og:description" content="<?php $i=0;while(isset($nomesarray[$i])){if($i>0){echo " + ";}echo $nomesarray[$i];$i++;}echo". Faça o teste você também!";?>"  />


		<script src="vendor/jquery/jquery.min.js"></script>
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">

        <link href="star/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
        <script src="star/js/star-rating.min.js" type="text/javascript"></script>

		<!-- end: MAIN CSS -->
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="shortcut icon" href="./favicon.ico">



		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->














  <script>
    $(document).ready(function(){
    $("#button1").click(function(){
        $("#hide1").toggle(500);
    });
});

    $(document).ready(function(){
    $("#button2").click(function(){
        $("#hide2").toggle(500);
    });
});

    $(document).ready(function(){
    $("#button3").click(function(){
        $("#hide3").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button4").click(function(){
        $("#hide4").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button5").click(function(){
        $("#hide5").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button6").click(function(){
        $("#hide6").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button7").click(function(){
        $("#hide7").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button8").click(function(){
        $("#hide8").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button9").click(function(){
        $("#hide9").toggle(500);
    });
});
    $(document).ready(function(){
    $("#button10").click(function(){
        $("#hide10").toggle(500);
    });
});
</script>

<script>
    var focus = 1;
window.onfocus = function(){focus=1;};
window.onblur =  function(){focus=0;};



    var tempo; var tempo2;
function Tempo(estado){
if(estado==1){
tempo = new Date();
tempo = tempo.getTime();
}
}

var detalhesabertos=0;
var totaldetalhes=0;

var tempod = 0; var tempod2; var tempodtotal=0;
var detalhescheck=0;
var estado=[0,0,0,0,0,0,0,0,0,0,0];
var foiaberto=[0,0,0,0,0,0,0,0,0,0,0];
function Detalhes(id,force){
//if(id>100){alert(tempodtotal+"/"+detalhescheck);return;}
var acao=0;
if(foiaberto[id]==0){foiaberto[id]=1;detalhesabertos++;}
if(estado[id]==0){estado[id]=1;acao=1;}else{estado[id]=0;acao=0;}
if(force==1&&detalhescheck>0){detalhescheck=1;acao=0;}
if(acao==1){detalhescheck++;}
if(acao==0){detalhescheck--;
    if(detalhescheck==0){tempod2 = new Date(); tempod2 = tempod2.getTime();tempodtotal=tempodtotal + tempod2 - tempod;}
}
if(tempod==0&&detalhescheck>0){
tempod = new Date();
tempod = tempod.getTime();
}
if(detalhescheck==0){tempod=0;}
}





  function feedbackjs() {
  tempo2 = new Date();
tempo2 = tempo2.getTime();
graf1 = document.getElementById("graf1").value;
graf2 = document.getElementById("graf2").value;
graf3 = document.getElementById("graf3").value;
timespent = tempo2 - tempo;
Detalhes(0,1);
        var xhr = new XMLHttpRequest();
        xhr.open('get',"feedback.php?id="+<?php echo $aux;?>+"&tempo="+timespent+"&graf1="+graf1+"&graf2="+graf2+"&graf3="+graf3+"&tempodetalhes="+tempodtotal+"&totaldetalhes="+totaldetalhes+"&detalhesabertos="+detalhesabertos,false);
        xhr.send();
}
  window.onbeforeunload = feedbackjs;




    </script>

	</head>
	<!-- end: HEAD -->
	<body onload="Tempo(1)">




	<div id="fb-root"></div>
		<script>


			  window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '598078936998567',
			      xfbml      : true,
			      version    : 'v2.4'
			    });
			  };

			  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=456156691222796";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
		</script>


		<div class="center bg-blue">
		<img src="./img/background.png" style="max-height:200px; width:auto;min-width:auto;max-width:100%;" width="auto" alt="Clip-two">
		</div>


		<?php




			echo ' <div class="text-center">
			<br></br>
			<h1>Este é o seu Perfil de Jogador!</h1>
			';
			echo '
			<table class="table table-condensed center">
			<tr>
			';

			$i = 0;
			$s = 0;
			$j = 0;
			$nomes = "";
			$teste = 0;
			foreach ($arrayNomeFatores as $value){
			$arrayFatores[$i] = str_replace(",", ".", $arrayFatores[$i]);
					$teste = $arrayFatores[$i]/$positivos;

				$teste = ($maiorValor/$positivos)-$teste;

				if ($teste <= 0.05) {

					$customQuery='SELECT  `descricao`, `nomeFantasia` FROM `subfator` WHERE id = '.$i.'+1';
					$query2 = $puxaBD->selectCustomQuery($customQuery);
					$queryLP = $query2->fetch_assoc();

					$descricao = $queryLP["descricao"];
					$nomeFantasia = $queryLP["nomeFantasia"];

				if($s!=0){
					$nomes .= ", ";
				}
					$nomes .= $nomeFantasia;
					$nomeDescr[$s]= $nomeFantasia;
					$descr[$s]=$descricao;
					$s = $s+1;

					$j = $i+1;
				if ($s % 4 == 1){
					echo '</tr><tr>';
				}
				else if($s > 0){
				echo '
				<td>&nbsp</td>
					<td>
					<img src="img/plus.png" width="50px" >
					</td>
					';
				}
									$customQuery='SELECT  `descricao`, `nomeFantasia` FROM `subfator` WHERE id = '.$i.'+1';
					$query2 = $puxaBD->selectCustomQuery($customQuery);
									$queryLP = $query2->fetch_assoc();

					$descricao = $queryLP["descricao"];
				$descr[$s]=$descricao;
				 echo '
<td>&nbsp</td>
	                                                                                    <td align="center"  class="box effect6" width="25%">
            <br></br>
	                                                                                         <h3>'.utf8_encode($nomeFantasia).' </h3> <br></br>
	                                                                                     <img src="./img/personalidade/'.$j.'.png" style="align: center;">
<br></br>

																						<div id="hide'.($s).'" hidden>
        <p style="margin-left: 10px;" align="left">
            '.utf8_encode($descr[$s]).'
            </p>
        <button type="button" class="btn btn-info" disabled="disabled">Saiba mais</button>
        <br></br>
        </div>
        <button type="button" class="btn btn-success" onclick="Detalhes('.$s.',0)" id="button'.($s).'">Detalhes</button>
        <script>totaldetalhes='.$s.';</script>
        <br></br>
        </td>



	 ';



				}

			$i = $i + 1;
			}

			echo '
			<td>&nbsp</td>
			 </tr>
			 </table>
			 ';
			 echo '




			</div>

			';
		?>

		<div class="text-center">
		    <div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button"></div>
		    <br><br>
		<h1>Veja detalhes dos seus resultados!</h1>
		<h4>Clique nos gráficos para obter mais informações!</h4>
		</div>

		<style>
		.chart {
		  width: 100%;
		  height: 600px;
		}
		</style>

			<div class="row">
			  <div class="col-xs-4">
				<div id="piechart" class="chart" style="height: 300px"></div>
				<center><div style="text-align: left; margin-left: 30%;"><b>Avalie este gráfico!</b></div></center>
				<center><div style="text-align: left; margin-left: 20%;"><input class="rating" data-size="xs" id="graf1"></div></center>
			  </div>
			  <div class="col-xs-4" style="text-align: center;">
                <canvas id="cvs" width="400" height="300">[No canvas support]</canvas>
                <center><div style="text-align: center;"><b>Avalie este gráfico!</b></div></center>
                <center><div style="text-align: left; margin-left: 30%;"><input class="rating" data-size="xs" id="graf2"></div></center>
			  </div>
			  <div class="col-xs-4">
				<div id="piechart2" class="chart" style="height: 300px"></div>
				<center><div style="text-align: left; margin-left: 30%;"><b>Avalie este gráfico!</b></div></center>
				<center><div style="text-align: left; margin-left: 20%;"><input class="rating" data-size="xs" id="graf3"></div></center>
			  </div>
			</div>


		<?php
		$i=0;
		while($i<10){
			echo '

				<div id="exp'.$i.'" class="text-justified">
					<h3>'.utf8_encode($explicacao[$i]).'</h3>
					<br></br>
				</div>
			';
			$i++;
		}
		?>

			<?php
		$i=0;
		while($i<10){
			echo '

				<div id="expbar'.$i.'" class="text-justified">
					<h3>'.utf8_encode($explicacao[$i]).'</h3>
				</div>
			';
			$i++;
		}
		?>

<br>
<center><div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button"></div></center><br>









				<?php
					if ($flag_resposta==1){
					echo '<div class="text-center" id="b2">
						<img id="imagemPerfil" />
						<h2 id="titulo" class="StepTitle"></h2>
						<p  id="descricao" class="text-large"></p>

						<div class="form-group">
							<label>
								<strong>Você concorda com o resultado?</strong> <span class="symbol required"></span>
							</label>
							</br>

							<a id="b1" class="btn btn-danger  submitConcordo" alt="nao"  >
								Não
							</a>
							<a id="b2" class="btn btn-success submitConcordo" alt="sim"  >
								Sim
							</a>
						</div>
					</div>';


							echo '
							<div class="text-center" id="b3">
										<label >
											<strong>Obrigado pela sua participação</strong> <span class="symbol required"></span>
										</label>
										<br></br>
										<a  class="btn btn-primary" href="http://200.144.255.42:8003/questionario/index.php">
											Refazer pesquisa.
										</a>
										<br></br>

									</div>

								</div>
						';
					}
					else {
					echo'
					<div class="text-center" id="b3">
										<br></br>

										<a  class="btn btn-primary"  href="http://200.144.255.42:8003/questionario/index.php">
											<h2 style="color:blue"><strong>Faça a pesquisa você também!</span></h2>
										</a>
									</div>
								</div>
					';
					}


					echo '
					<p>
					"*O presente questionário pretende avaliar uma teoria do Arquétipo de Jogador (Tipologia de Jogador ou Player Type) derivada do Teste de Bartle (https://pt.wikipedia.org/wiki/Arqu%C3%A9tipos_de_Bartle), estando ainda em sua fase inicial. Por isso, o resultado aqui apresentado são aproximações da combinação dos subcomponentes com maior pontuação no questionário. Gostaríamos de registrar e refroçar o caráter experimental da ferramenta aqui oferecida. Caso opte por recebere posteriormente uma avaliação do perfil de jogador mais precisa ficaremos contentes em lhe enviar após uma análise ampla com o público brasileiro."
					</p>
					';
				?>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="vendor/jquery-smart-wizard/jquery.smartWizard.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-wizard.js"></script>
		<script>

			jQuery(document).ready(function() {







			$(".submitConcordo").click(function (e) {
            	var check = $(this).attr("alt");//pega o atributo alt do ultimo elemento instanciado.
            		var	idResposta = "<?php echo $aux; ?>";
            		var	tipoJogador = "<?php echo $nomes; ?>";

            			$.ajax({
					url : 'http://200.144.255.42:8003/questionario/saveData2.php?concordo',
					type: 'POST',
					dataType: 'json',
					data: ({respostaOpinao:check , respostaId:idResposta, respostaTipoJogador:tipoJogador}),

					success: function(dados){

					}

		   		});

			if(check=="nao"){
			url = "http://200.144.255.42:8003/questionario/nconcordo.php?id="+idResposta;
				window.location.assign(url);
			}
			else if(<?php echo $flag_resposta; ?> == 1){
			{document.getElementById("b3").style.display="block";}
			{document.getElementById("b2").style.display="none";}
			}
	//		window.location.assign('http://200.144.255.42:8003/questionario/index.php');

		});

		});


			function finalizar(){
				window.location.assign('http://200.144.255.42:8003/questionario/index.php');
			}






		</script>


		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

	</body>
</html>
