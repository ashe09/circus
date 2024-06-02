<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_SESSION["payment"]) || !isset($_SESSION["addressee"]) || !isset($_SESSION["postcode2"]) || !isset($_SESSION["add2"])) {
  header("Location: purchase.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 

$_POST = checkInput( $_POST );
$g_id = h($_SESSION["g_id"]);
$g_name = h($_SESSION["g_name"]);
$image1 = h($_SESSION["image1"]);
$price = h($_SESSION["price"]);
$selectQuantity = h($_SESSION["selectQuantity"]);
$shipping_fee = h($_SESSION["shipping_fee"]);
$subTotal = h($_SESSION["subTotal"]);
$total = h($_SESSION["total"]);

$payment = h($_SESSION["payment"]);
$addressee = h($_SESSION["addressee"]);
$postcode2 = h($_SESSION["postcode2"]);
$add2 = h($_SESSION["add2"]);
$u_id = h($_SESSION['user']);
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists purchase (id int(11) not null primary key auto_increment,u_id int(11),g_id int(11),g_name varchar(50),image1 varchar(255),price int(11),selectQuantity int(11),shipping_fee int(11),subTotal int(11),total int(11),payment varchar(30),addressee varchar(50),postcode2 varchar(9),address2 varchar(255),create_date datetime, FOREIGN KEY (u_id) REFERENCES users(id) ON UPDATE CASCADE
// ON DELETE SET NULL, FOREIGN KEY (g_id) REFERENCES gifts(id) ON UPDATE CASCADE
// ON DELETE SET NULL)";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO purchase (u_id,g_id,g_name,image1,price,selectQuantity,shipping_fee,subTotal,total,payment,addressee,postcode2,address2,create_date) VALUES (:u_id,:g_id,:g_name,:image1,:price,:selectQuantity,:shipping_fee,:subTotal,:total,:payment,:addressee,:postcode2,:address2,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":u_id", $u_id, PDO::PARAM_STR );
$stmt->bindParam ( ":g_id", $g_id, PDO::PARAM_STR );
$stmt->bindParam ( ":g_name", $g_name, PDO::PARAM_STR );
$stmt->bindParam ( ":image1", $image1, PDO::PARAM_STR );
$stmt->bindParam ( ":price", $price, PDO::PARAM_STR );
$stmt->bindParam ( ":selectQuantity", $selectQuantity, PDO::PARAM_STR );
$stmt->bindParam ( ":shipping_fee", $shipping_fee, PDO::PARAM_STR );
$stmt->bindParam ( ":subTotal", $subTotal, PDO::PARAM_STR );
$stmt->bindParam ( ":total", $total, PDO::PARAM_STR );
$stmt->bindParam ( ":payment", $payment, PDO::PARAM_STR );
$stmt->bindParam ( ":addressee", $addressee, PDO::PARAM_STR );
$stmt->bindParam ( ":postcode2", $postcode2, PDO::PARAM_STR );
$stmt->bindParam ( ":address2", $add2, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;
?>

<?php include('header_purchase.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Thanks</h2>
          <p>ご購入いただき、<span class="newLine560">ありがとうございます。</span><br>
            手続きが完了いたしました。</p>
          <a href="index.php" class="tapButton">Giftsページ</a>
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_purchase.php'); ?>

<?php
	unset($_SESSION['g_id']);
	unset($_SESSION['g_name']);
	unset($_SESSION['image1']);
	unset($_SESSION['price']);
	unset($_SESSION['selectQuantity']);
	unset($_SESSION['shipping_fee']);
	unset($_SESSION['subTotal']);
	unset($_SESSION['total']);
	unset($_SESSION['payment']);
	unset($_SESSION['addressee']);
	unset($_SESSION['postcode2']);
	unset($_SESSION['add2']);
	unset($_SESSION['error']);
?>
