<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_SESSION["eventTitle"])) {
  header("Location: index.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 

$_POST = checkInput( $_POST );

$eventTitle = h($_SESSION["eventTitle"]);
$date = h($_SESSION["date"]);
$time = h($_SESSION["time"]);
$name = h($_SESSION["name"]);
$email = h($_SESSION["email"]);
$tel = h($_SESSION["tel"]);
$medium = h($_SESSION["medium"]);
$media = implode(",",$medium);
$comment = h($_SESSION["comment"]);
$appDate = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists event_app (id int(11) not null primary key auto_increment,eventTitle varchar(50),date varchar(20),time varchar(20),name varchar(50),email varchar(50),tel varchar(15),medium varchar(20),comment text,create_date datetime)";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO event_app (eventTitle,date,time,name,email,tel,medium,comment,create_date) VALUES (:eventTitle,:date,:time,:name,:email,:tel,:medium,:comment,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":eventTitle", $eventTitle, PDO::PARAM_STR );
$stmt->bindParam ( ":date", $date, PDO::PARAM_STR );
$stmt->bindParam ( ":time", $time, PDO::PARAM_STR );
$stmt->bindParam ( ":name", $name, PDO::PARAM_STR );
$stmt->bindParam ( ":email", $email, PDO::PARAM_STR );
$stmt->bindParam ( ":tel", $tel, PDO::PARAM_STR );
$stmt->bindParam ( ":medium", $media, PDO::PARAM_STR );
$stmt->bindParam ( ":comment", $comment, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date",$appDate, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
if(!isset($user)) {
	$_SESSION = array();
	session_destroy();
}
?>

<?php include('header_eventApp.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Thanks</h2>
          <p>お申し込みいただき、<span class="newLine560">ありがとうございます。<br>
            受付完了いたしました。<br>
            後日詳細メールをお送りいたします。</p>
          <a href="../eventPage.php" class="tapButton">Eventページ</a>
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_eventApp.php'); ?>

<?php
if(isset($user)) {
	unset($_SESSION['eventTitle']);
	unset($_SESSION['date']);
	unset($_SESSION['time']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['tel']);
	unset($_SESSION['medium']);
	unset($_SESSION['comment']);
}
?>