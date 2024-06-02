<?php
session_start();
session_regenerate_id( TRUE );
header("X-FRAME-OPTIONS: SAMEORIGIN");
ini_set('display_errors', 0);
require 'functions.php';

if (!isset($_POST["name"])){
  header("Location:index.php");
  exit();
} 

$tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
$updatefile = isset($_FILES['update_photo']) ? $_FILES['update_photo'] : NULL;
$profile = isset($_POST['profile']) ? $_POST['profile'] : NULL;
$url = isset($_POST['url']) ? $_POST['url'] : NULL;

$_POST = checkInput( $_POST );
$name = h($_POST["name"]);
$ruby = h($_POST["ruby"]);
$u_name = h($_POST["u_name"]);
$email = h($_POST["email"]);
$pass = h($_POST["password"]);
$password_hash = md5($pass);
$role = h($_POST["role"]);
$postcode = h($_POST["postcode"]);
$add = h($_POST["add"]);
$tel = h($_POST["tel"]);
$updatefile = $_FILES['update_photo'];
$file_name = $updatefile['name'];
$ex = strtolower(mb_strrchr($file_name,'.',FALSE));
$profile = h($_POST["profile"]);
$url = h($_POST["url"]);

$name = trim($name);
$name = mb_convert_kana($name,"S");
$ruby = trim($ruby);
$ruby = mb_convert_kana($ruby,"S");
$ruby = mb_convert_kana($ruby,"H");
$ruby = mb_convert_kana($ruby,"c");
$u_name = trim($u_name);
$u_name = mb_convert_kana($u_name,"a");
$u_name = mb_convert_kana($u_name,"K");
$email = trim($email);
$postcode = trim($postcode);
$postcode = mb_convert_kana($postcode,"n");
$postcode = str_replace(array('-', 'ー', '−', '―', '‐'), '', $postcode);
$add = trim($add);
$add = mb_convert_kana($add,"a");
$add = str_replace(array('-', 'ー', '−', '―', '‐'), '-', $add);
$tel = trim($tel);
$tel = str_replace(array('-', 'ー', '−', '―', '‐'), '', $tel);
$tel = mb_convert_kana($tel,"a");
$profile = trim($profile);
$profile = mb_convert_kana($profile,"a");
$profile = mb_convert_kana($profile,"K");
$url = trim($url);

$error = array();

$max_size = 1900*1200;
if (!empty($file_name)) {
  if(($updatefile['type']!='image/jpeg' 
	&& $updatefile['type']!='image/pjpeg'
	&& $updatefile['type']!='image/png'
	&& $updatefile['type']!='image/gif')
	|| ($ex!=".jpg" && $ex!=".jepg"  && $ex!=".png" && $ex!=".gif" )){
    unlink($updatefile['tmp_name']);
    $error['photo'] = '　＊画像の形式が正しくありません。';
  } elseif ($updatefile['size']>$max_size) {
    unlink($updatefile['tmp_name']);
    $error['photo'] = '　＊アップロードできるサイズを超えています。';
  } else {

    $app_datetime=date('YmdHis');
    $fn=$app_datetime.$updatefile['name'];
    move_uploaded_file($updatefile['tmp_name'],'../signup/original_uphoto/'.$fn);
  
    $file1 = "../signup/original_uphoto/$fn";
    $file2 = "../signup/thumb_uphoto/$fn";

    switch($ex){
      case '.jpeg':
      case '.jpg';
        $in=imagecreatefromjpeg($file1);
        break;
      case '.png':
        $in=imagecreatefrompng($file1);
        break;
      case '.gif':
        $in=imagecreatefromgif($file1);
        break;
    }

    $size = getimagesize($file1);  
    $width=300;
    $height = $size[1]*$width/$size[0];

    $out = imagecreatetruecolor($width, $height);
    imagealphablending($out, false);
    imagesavealpha($out, true);
    ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$size[0],$size[1]);
  
    switch ($ex) {
      case '.jpeg':
      case '.jpg';
        ImageGIF($out, $file2);
        break;
      case '.png':
        ImageJPEG($out, $file2);
        break;
      case ".gif":
        ImagePNG($out, $file2);
        break;
    }
    ImageDestroy($in);
    ImageDestroy($out);
  }
}

$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location: index.php");
  exit();
}


date_default_timezone_set('Asia/Tokyo'); 
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

$sql = "UPDATE users set name=:name,ruby=:ruby,u_name=:u_name,email=:email,password=:password,role=:role,postcode=:postcode,address=:address,tel=:tel,photo=:photo,profile=:profile,url=:url,create_date=:create_date WHERE email = :email";
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
?>

<?php include('header_mypage.php'); ?>
      <main>
        <div class="mypage cWrapper">
					<h2 class="sectionTitle">Profile変更</h2>
          <p>プロフィール変更手続きが完了いたしました。</p>
          <a href="index.php" class="tapButton">MyPageへ</a>
        </div><!-- /.mypage cWrapper-->
      </main><!-- /main -->
<?php include('footer_mypage.php'); ?>