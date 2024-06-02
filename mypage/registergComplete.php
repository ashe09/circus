<?php
session_start();
session_regenerate_id( TRUE );
header("X-FRAME-OPTIONS: SAMEORIGIN");
ini_set('display_errors', 0);
require 'functions.php';

if (!isset($_POST["g_name"])){
  header("Location:index.php");
  exit();
} 

$size = isset($_POST['size']) ? $_POST['size'] : NULL;
$material = isset($_POST['material']) ? $_POST['material'] : NULL;
$g_url = isset($_POST['g_url']) ? $_POST['g_url'] : NULL;

$_POST = checkInput( $_POST );

$gc_name = h($_POST["gc_name"]);
$g_name = h($_POST["g_name"]);
$price = h($_POST["price"]);
$giftsfile = $_FILES['giftsImg'];
$file_name = $giftsfile['name'];
$g_desc = h($_POST["g_desc"]);
$g_quantity = h($_POST["g_quantity"]);
$g_type = h($_POST["g_type"]);
$size = h($_POST["size"]);
$material = h($_POST["material"]);
$pay_method = $_POST["pay_method"];
$pay_methodDB = implode(",",$pay_method);
$delivery = h($_POST["delivery"]);
$shipping_fee = h($_POST["shipping_fee"]);
$g_url = h($_POST["g_url"]);
$g_u_id = $_SESSION['user'];

$g_name = trim($g_name);
$g_name = mb_convert_kana($g_name,"S");
$price = trim($price);
$price = mb_convert_kana($price,"n");
$g_desc = trim($g_desc);
$g_desc = mb_convert_kana($g_desc,"S");
$g_desc = mb_convert_kana($g_desc,"a");
$g_desc = mb_convert_kana($g_desc,"K");
$g_type = trim($g_type);
$g_type = mb_convert_kana($g_type,"S");
$g_type = mb_convert_kana($g_type,"a");
$g_type = mb_convert_kana($g_type,"K");
$size = trim($size);
$size = mb_convert_kana($size,"a");
$material = trim($material);
$material = mb_convert_kana($material,"S");
$material = mb_convert_kana($material,"a");
$material = mb_convert_kana($material,"K");
$shipping_fee = trim($shipping_fee);
$shipping_fee = mb_convert_kana($shipping_fee,"n");
$g_url = trim($g_url);


$error = array();
$max_size = 1900*1200;
for ($i=0; $i<3; $i++) {
  $file_ext = pathinfo($file_name[$i], PATHINFO_EXTENSION);
  if (FileExtensionGetAllowUpload($file_ext) && is_uploaded_file($giftsfile["tmp_name"][$i])) {
    if ($giftsfile['size'][$i]>$max_size) {
      unlink($giftsfile['tmp_name'][$i]);
      $error['giftsImg'] = '　＊アップロードできるサイズを超えています。';
    } else {
      $directory = "original_gphoto";
      $app_datetime=date('YmdHis');
      if(!is_dir($directory)){mkdir($directory);}
      move_uploaded_file($giftsfile["tmp_name"][$i], "./original_gphoto/".$app_datetime.$file_name[$i]);
    }
  } else {
    $error['giftsImg'] = '　＊ファイルをアップロードしてください。';
  }
}
function FileExtensionGetAllowUpload($ext) {
  $allow_ext = array("gif","jpg","jpeg","png");
  foreach($allow_ext as $v){
    if ($v === $ext){
      return 1;
    }
  }
  return 0;
}
$fn01 = $app_datetime.$file_name[0];
$fn02 = $app_datetime.$file_name[1];
$fn03 = $app_datetime.$file_name[2];

if (!isset($pay_method)) {
  $error['pay_method'] = '　＊どちらかを選択してください。';
}
if ($g_url != '' && preg_match( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $g_url ) == 0 ) {
  $error['g_url'] = '　＊urlの形式が正しくありません。';
}

$_SESSION["gc_name"] = $gc_name;
$_SESSION["g_name"] = $g_name;
$_SESSION["price"] = $price;
$_SESSION["g_desc"] = $g_desc;
$_SESSION["g_quantity"] = $g_quantity;
$_SESSION["g_type"] = $g_type;
$_SESSION["size"] = $size;
$_SESSION["material"] = $material;
$_SESSION["pay_method"] = $pay_method;
$_SESSION["delivery"] = $delivery;
$_SESSION["shipping_fee"] = $shipping_fee;
$_SESSION["g_url"] = $g_url;
$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location: index.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists gifts (id int(11) not null primary key auto_increment,c_name varchar(30),g_name varchar(50),price int(11),image1 varchar(255),image2 varchar(255),image3 varchar(255),quantity int(11),description text,type varchar(30),size varchar(255),material varchar(255),pay_method varchar(50),delivery varchar(50),shipping_fee int(11),url text,u_id int(11),create_date datetime, FOREIGN KEY (u_id) REFERENCES users(id) ON UPDATE CASCADE
// ON DELETE SET NULL)";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO gifts (c_name,g_name,price,image1,image2,image3,quantity,description,type,size,material,pay_method,delivery,shipping_fee,url,u_id,create_date) VALUES (:c_name,:g_name,:price,:image1,:image2,:image3,:quantity,:description,:type,:size,:material,:pay_method,:delivery,:shipping_fee,:url,:u_id,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":c_name", $gc_name, PDO::PARAM_STR );
$stmt->bindParam ( ":g_name", $g_name, PDO::PARAM_STR );
$stmt->bindParam ( ":price", $price, PDO::PARAM_STR );
$stmt->bindParam ( ":image1", $fn01, PDO::PARAM_STR );
$stmt->bindParam ( ":image2", $fn02, PDO::PARAM_STR );
$stmt->bindParam ( ":image3", $fn03, PDO::PARAM_STR );
$stmt->bindParam ( ":quantity", $g_quantity, PDO::PARAM_STR );
$stmt->bindParam ( ":description", $g_desc, PDO::PARAM_STR );
$stmt->bindParam ( ":type", $g_type, PDO::PARAM_STR );
$stmt->bindParam ( ":size", $size, PDO::PARAM_STR );
$stmt->bindParam ( ":material", $material, PDO::PARAM_STR );
$stmt->bindParam ( ":pay_method", $pay_methodDB, PDO::PARAM_STR );
$stmt->bindParam ( ":delivery", $delivery, PDO::PARAM_STR );
$stmt->bindParam ( ":shipping_fee", $shipping_fee, PDO::PARAM_STR );
$stmt->bindParam ( ":url", $g_url, PDO::PARAM_STR );
$stmt->bindParam ( ":u_id", $g_u_id, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;
?>

<?php include('header_mypage.php'); ?>
      <main>
        <div class="mypage cWrapper">
					<h2 class="sectionTitle">Gifts登録</h2>
          <p>Gifts登録手続きが完了いたしました。</p>
          <a href="index.php" class="tapButton">MyPageへ</a>
        </div><!-- /.mypage cWrapper-->
      </main><!-- /main -->
<?php include('footer_mypage.php'); ?>

<?php
	unset($_SESSION['gc_name']);
	unset($_SESSION['g_name']);
	unset($_SESSION['price']);
	unset($_SESSION['g_desc']);
	unset($_SESSION['g_quantity']);
	unset($_SESSION['g_type']);
	unset($_SESSION['size']);
	unset($_SESSION['material']);
	unset($_SESSION['pay_method']);
	unset($_SESSION['delivery']);
	unset($_SESSION['shipping_fee']);
	unset($_SESSION['g_url']);
	unset($_SESSION['error']);
?>