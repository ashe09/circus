<?php
session_start(); 
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_SESSION["kind"]) || !isset($_SESSION["company"]) || !isset($_SESSION["name"]) || !isset($_SESSION["email"]) || !isset($_SESSION["tel"]) || !isset($_SESSION["inquiry"])) {
  header("Location: index.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 

$_POST = checkInput( $_POST );

$kind = h($_SESSION["kind"]);
$company = h($_SESSION["company"]);
$name = h($_SESSION["name"]);
$email = h($_SESSION["email"]);
$tel = h($_SESSION["tel"]);
$inquiry = h($_SESSION["inquiry"]);

$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

$sql = "INSERT INTO contact (kind,company,name,email,tel,inquiry,create_date) VALUES (:kind,:company,:name,:email,:tel,:inquiry,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":kind", $kind, PDO::PARAM_STR );
$stmt->bindParam ( ":company", $company, PDO::PARAM_STR );
$stmt->bindParam ( ":name", $name, PDO::PARAM_STR );
$stmt->bindParam ( ":email", $email, PDO::PARAM_STR );
$stmt->bindParam ( ":tel", $tel, PDO::PARAM_STR );
$stmt->bindParam ( ":inquiry", $inquiry, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date",$date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

if(!isset($user)) {
	$_SESSION = array();
	session_destroy();
}
?>

<?php include('header_contact.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Thanks</h2>
          <p>お問い合せいただき、ありがとうございます。<br>
            送信完了いたしました。<br>
            折返しのご連絡までしばらくお待ちください。</p>
            <!-- <?php //echo $text; ?> -->
          <a href="index.php" class="tapButton">Contactページ</a>
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_contact.php'); ?>

<?php
if(isset($user)) {
	unset($_SESSION['kind']);
	unset($_SESSION['company']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['tel']);
	unset($_SESSION['inquiry']);
}
?>
