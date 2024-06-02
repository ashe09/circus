<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_SESSION["name"]) || !isset($_SESSION["ruby"]) || !isset($_SESSION["u_name"]) || !isset($_SESSION["email"]) || !isset($_SESSION["password"]) || !isset($_SESSION["role"]) || !isset($_SESSION["postcode"]) || !isset($_SESSION["add"]) || !isset($_SESSION["tel"]) || !isset($_SESSION["photo"]) || !isset($_SESSION["profile"]) || !isset($_SESSION["url"])) {
  header("Location: index.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 

$_POST = checkInput( $_POST );

$name = h($_SESSION["name"]);
$ruby = h($_SESSION["ruby"]);
$u_name = h($_SESSION["u_name"]);
$email = h($_SESSION["email"]);
$password_hash = h($_SESSION["password"]);
$role = h($_SESSION["role"]);
$postcode = h($_SESSION["postcode"]);
$add = h($_SESSION["add"]);
$tel = h($_SESSION["tel"]);
$file_name = h($_SESSION["photo"]);
$fn = h($_SESSION["fn"]);
$profile = h($_SESSION["profile"]);
$url = h($_SESSION["url"]);
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists users (id int(11) not null primary key auto_increment,name varchar(50),ruby varchar(70),u_name varchar(50),email varchar(50) not null unique,password varchar(255),role varchar(15),postcode varchar(9),address varchar(255),tel varchar(15),photo varchar(255),profile text,url text,create_date datetime,type varchar(1))";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO users (name,ruby,u_name,email,password,role,postcode,address,tel,photo,profile,url,create_date) VALUES (:name,:ruby,:u_name,:email,:password,:role,:postcode,:address,:tel,:photo,:profile,:url,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":name", $name, PDO::PARAM_STR );
$stmt->bindParam ( ":ruby", $ruby, PDO::PARAM_STR );
$stmt->bindParam ( ":u_name", $u_name, PDO::PARAM_STR );
$stmt->bindParam ( ":email", $email, PDO::PARAM_STR );
$stmt->bindParam ( ":password", $password_hash, PDO::PARAM_STR );
$stmt->bindParam ( ":role", $role, PDO::PARAM_STR );
$stmt->bindParam ( ":postcode", $postcode, PDO::PARAM_STR );
$stmt->bindParam ( ":address", $add, PDO::PARAM_STR );
$stmt->bindParam ( ":tel", $tel, PDO::PARAM_STR );
$stmt->bindParam ( ":photo", $fn, PDO::PARAM_STR );
$stmt->bindParam ( ":profile", $profile, PDO::PARAM_STR );
$stmt->bindParam ( ":url", $url, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;

$_SESSION = array();
session_destroy();
?>

<?php include('header_signup.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Sign up</h2>
          <p>登録手続きが完了しました。<br>
            下記ボタンよりCIRCUSをお楽しみください。</p>
          <a href="../index.php" class="tapButton">Topページ</a>
        </div><!-- /.cWrapper -->
      </main><!-- /main -->

<?php include('footer_signup.php'); ?>