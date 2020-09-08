<?php
 header("Content-type: text/html; charset=utf-8");
setlocale(LC_ALL, 'pt_BR.UTF8');

$endereco = './index.php';
$resultado = './resultado.php';
$salvar = './saveData.php';

/*
  $endereco = 'http://localhost/git/questionarioLocal/index.php';
  $resultado = 'http://localhost/git/questionarioLocal/resultado3c.php';
  $salvar = 'http://localhost/git/questionarioLocal/saveData3.php'; */

Class Crud {

   var $tabela;
   var $campos;
   var $valores;
   var $condicao;
   var $error = "erro";
   var $sucess = "sucesso";
   var $id;
   var $conn;
   var $bind_param;
   var $bind_param_values;
   private $url = "bd.cfg";
   private $DB_HOSTNAME = '';
   private $DB_USERNAME = '';
   private $DB_PASSWORD = '';
   private $DB_DATABASE = '';

   function __construct() {


      $file = file_get_contents($this->url);
      $contents = utf8_encode($file);
      $results = json_decode($contents, true);

      $this->DB_HOSTNAME = $results['DB_HOSTNAME'];
      $this->DB_USERNAME = $results['DB_USERNAME'];
      $this->DB_PASSWORD = $results['DB_PASSWORD'];
      $this->DB_DATABASE = $results['DB_EXPERIMENTAL'];
   }

   /* 	private $DB_HOSTNAME = 'localhost';
     private $DB_USERNAME = 'root';
     private $DB_PASSWORD = '';
     private $DB_DATABASE = 'bd'; */

   function conn() {
      $this->conn = new mysqli($this->DB_HOSTNAME, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_DATABASE, 3306);
      if (mysqli_connect_errno()) {
         echo nl2br("Error: Could not connect to database \n " . mysqli_connect_error() . "\n\n"); //echo + \n need nl2br function
         echo "Erro: Não foi possível conectar com o banco de dados \n \n \n";
         echo $url . "," . $this->DB_HOSTNAME . "," . $this->DB_USERNAME . "," . $this->DB_PASSWORD . "\n \n" . mysqli_connect_error();
         exit;         
      }      
      return $this->conn;
   }

   function selectDB($DB) {
      return $this->conn->select_db($DB);
   }

   function setCharSet() {
      consoleLog("Charset utf8mb4");
      //$this->conn->set_charset("utf8");
       $this->conn->set_charset("utf8mb4");
       //$this->conn->query("set names utf8");
      
       if ( TRUE !==  $this->conn->set_charset( 'utf8' ) )
    throw new \Exception(  $this->conn->errno );

      if ( TRUE !==  $this->conn->query( 'SET collation_connection = @@collation_database;' ) )
    throw new \Exception(  $this->conn->errno );
      
   }

   function close() {
      return $this->conn->close();
   }

   function insert($campos, $tabela, $valores) {
      $this->campos = $campos;
      $this->valores = $valores;
      $this->tabela = $tabela;
      $this->query = "insert into $this->tabela ($this->campos) values ($this->valores)";
      $conn = $this->conn;
      $query = $conn->prepare($this->query);
      return $query;
   }

   function fastInsert($campos, $tabela, $valores) {
      $this->campos = $campos;
      $this->valores = $valores;
      $this->tabela = $tabela;
      $this->query = "insert into $this->tabela ($this->campos) values ($this->valores)";
      $conn = $this->conn;
      $w = $conn->query($this->query);
      return $w;
   }

   function update($valores, $tabela, $condicao) {
      $this->valores = $valores;
      $this->condicao = $condicao;
      $this->tabela = $tabela;
      $this->query = "update $this->tabela set $this->valores where $this->condicao";
      $conn = $this->conn;
      $query = $conn->prepare($this->query);
      return $query;
   }

   function selectArrayConditions($campos, $tabela, $condicao) {
      $this->campos = implode(",", $campos);
      $this->tabela = $tabela;
      $this->condicao = $condicao;
      $conn = $this->conn;
      $query = $conn->prepare("SELECT $this->campos FROM $this->tabela WHERE $this->condicao");
      return $query;
   }

   function selectArrayPostWhere($campos, $tabela, $condicao) {
      $this->campos = $campos;
      $this->tabela = $tabela;
      $this->condicao = $condicao;
      $this->query = "select $this->campos from $this->tabela $this->condicao";
      $conn = $this->conn;
      $w = $conn->query($this->query);
      return $w;
   }

   function selectCustomQuery($custom) {
      $this->custom = $custom;
      $conn = $this->conn;
      $w = $conn->query($this->custom);
      return $w;
   }

   function getLastID() {
      $conn = $this->conn;
      $w = $conn->insert_id;
      return $w;
   }

   function getAffectedRows() {
      $conn = $this->conn;
      $num = $conn->affected_rows;
      return $num;
   }

   function selectArray($campos) {
      $this->campos = $campos;
      $this->query = "select $this->campos from $this->tabela";
      $w = mysql_query("$this->query");
      return $w;
   }

   function selectDistinct($campos, $tabela, $condicao) {
      $this->campos = $campos;
      $this->condicao = $condicao;
      $this->tabela = $tabela;
      $this->query = "SELECT DISTINCT $this->campos from $this->tabela $this->condicao";
      $conn = $this->conn;
      $w = $conn->query($this->query);
      return $w;
   }

   function delete($tabela, $condicao) {
      $this->condicao = $condicao;
      $this->tabela = $tabela;
      $this->query = "delete from $this->tabela where $this->condicao";
      $conn = $this->conn;
      $w = $conn->query($this->query);
      return $w;
   }

   function setMsgSucesso($msg) {
      $this->sucess = $msg;
   }

   function setMsgErro($msg) {
      $this->error = $msg;
   }

   function real_escape_string($var) {
      $this->value = $var;
      $conn = $this->conn;
      $w = $conn->real_escape_string($this->value);
      return $w;
   }

   function maiorValor(array $maiorValor) {
      $nomeCorreto = array("Avanco" => "Avanco", "Competicao" => "Competicao", "Mecanica" => "Mecanica", "Socializacao" => "Socializacao", "Relacionamento" => "Relacionamento", "Trabalhoequipe" => "Trabalho em equipe", "Descoberta" => "Descoberta", "Roleplaying" => "Role Playing", "Customizacao" => "Customizacao", "Escapismo" => "Escapismo", "empate" => "Empate");
      $valorAtual = 0;
      $valorIgual = 0;
      $arrayPerfisEmpate = array();
      $retorno = array();
      foreach ($maiorValor as $key => $value) {
         if ($value > $valorAtual) {
            $valorAtual = $value;
            $perfilPrincipal = $key;
         } elseif ($value == $valorAtual) {
            $valorIgual = $valorAtual;
            $arrayPerfisEmpate[] = $key;
         }
      }
      if ($valorIgual == $valorAtual) {
         //teve impate
         $perfilPrincipal = "empate";
      }
      $retorno['perfisEmpate'] = $arrayPerfisEmpate;
      $retorno['nomeCorreto'] = $nomeCorreto[$perfilPrincipal];
      return $retorno;
   }
}

//General functions
function fetchAll($result) {
   while ($row = $result->fetch_assoc()) {
      $results_array[] = $row;
   }
   return $results_array;
}

function consoleLog($texto) {
   echo "<script> console.log('$texto'); </script>";
}

?>
