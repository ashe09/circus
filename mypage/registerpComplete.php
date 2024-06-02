<?php
session_start();
session_regenerate_id( TRUE );
header("X-FRAME-OPTIONS: SAMEORIGIN");
ini_set('display_errors', 0);
require 'functions.php';

if (!isset($_POST["p_name"])){
  header("Location:index.php");
  exit();
} 

$target = isset($_POST['target']) ? $_POST['target'] : NULL;
$workRange = isset($_POST['workRange']) ? $_POST['workRange'] : NULL;
$p_url = isset($_POST['p_url']) ? $_POST['p_url'] : NULL;

$_POST = checkInput( $_POST );

$pc_name = h($_POST["pc_name"]);
$p_name = h($_POST["p_name"]);
$pay = h($_POST["pay"]);
$projectsfile = $_FILES['projectsImg'];
$file_name = $projectsfile['name'];
$p_desc = h($_POST["p_desc"]);
$p_type = h($_POST["p_type"]);
$target = h($_POST["target"]);
$workRange = h($_POST["workRange"]);
$pPay_method = $_POST["pPay_method"];
$pPay_methodDB = implode(",",$pPay_method);
$es_year = h($_POST["es_year"]);
$es_month = h($_POST["es_month"]);
$es_day = h($_POST["es_day"]);
$ed_year = h($_POST["ed_year"]);
$ed_month = h($_POST["ed_month"]);
$ed_day = h($_POST["ed_day"]);
$schedule = h($_POST["schedule"]);
$p_url = h($_POST["p_url"]);
$p_u_id = $_SESSION['user'];

$p_name = trim($p_name);
$p_name = mb_convert_kana($p_name,"S");
$pay = trim($pay);
$pay = mb_convert_kana($pay,"n");
$p_desc = trim($p_desc);
$p_desc = mb_convert_kana($p_desc,"S");
$p_desc = mb_convert_kana($p_desc,"a");
$p_desc = mb_convert_kana($p_desc,"K");
$p_type = trim($p_type);
$p_type = mb_convert_kana($p_type,"S");
$p_type = mb_convert_kana($p_type,"a");
$p_type = mb_convert_kana($p_type,"K");
$target = trim($target);
$target = mb_convert_kana($target,"a");
$target = mb_convert_kana($target,"K");
$workRange = trim($workRange);
$workRange = mb_convert_kana($workRange,"S");
$workRange = mb_convert_kana($workRange,"a");
$workRange = mb_convert_kana($workRange,"K");
$es_year = trim($es_year);
$es_year = mb_convert_kana($es_year,"n");
$ed_year = trim($ed_year);
$ed_year = mb_convert_kana($ed_year,"n");
$schedule = trim($schedule);
$schedule = mb_convert_kana($schedule,"S");
$schedule = mb_convert_kana($schedule,"a");
$schedule = mb_convert_kana($schedule,"K");
$p_url = trim($p_url);

$error = array();
$max_size = 1900*1200;
for ($i=0; $i<3; $i++) {
  $file_ext = pathinfo($file_name[$i], PATHINFO_EXTENSION);
  if (FileExtensionGetAllowUpload($file_ext) && is_uploaded_file($projectsfile["tmp_name"][$i])) {
    if ($projectsfile['size'][$i]>$max_size) {
      unlink($projectsfile['tmp_name'][$i]);
      $error['projectsImg'] = '　＊アップロードできるサイズを超えています。';
    } else {
      $directory = "original_pphoto";
      $app_datetime=date('YmdHis');
      if(!is_dir($directory)){mkdir($directory);}
      move_uploaded_file($projectsfile["tmp_name"][$i], "./original_pphoto/".$app_datetime.$file_name[$i]);
    }
  } else {
    $error['projectsImg'] = '　＊ファイルをアップロードしてください。';
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

if (!isset($pPay_method)) {
  $error['pPay_method'] = '　＊いずれかを選択してください。';
}
if ($p_url != '' && preg_match( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $p_url ) == 0 ) {
  $error['p_url'] = '　＊urlの形式が正しくありません。';
}

$_SESSION["pc_name"] = $pc_name;
$_SESSION["p_name"] = $p_name;
$_SESSION["pay"] = $pay;
$_SESSION["p_desc"] = $p_desc;
$_SESSION["p_type"] = $p_type;
$_SESSION["target"] = $target;
$_SESSION["workRange"] = $workRange;
$_SESSION["pPay_method"] = $pPay_method;
$_SESSION["es_year"] = $es_year;
$_SESSION["es_month"] = $es_month;
$_SESSION["es_day"] = $es_day;
$_SESSION["ed_year"] = $ed_year;
$_SESSION["ed_month"] = $ed_month;
$_SESSION["ed_day"] = $ed_day;
$_SESSION["schedule"] = $schedule;
$_SESSION["p_url"] = $p_url;
$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location: index.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists projects (id int(11) not null primary key auto_increment,c_name varchar(30),p_name varchar(50),pay int(11),image1 varchar(255),image2 varchar(255),image3 varchar(255),description text,type varchar(30),target varchar(255),workRange varchar(255),pay_method varchar(50),startY int(4),startM int(2),startD int(2),deadlineY int(4),deadlineM int(2),deadlineD int(2),schedule text,url text,u_id int(11),create_date datetime, FOREIGN KEY (u_id) REFERENCES users(id) ON UPDATE CASCADE
// ON DELETE SET NULL)";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO projects (c_name,p_name,pay,image1,image2,image3,description,type,target,workRange,pay_method,startY,startM,startD,deadlineY,deadlineM,deadlineD,schedule,url,u_id,create_date) VALUES (:c_name,:p_name,:pay,:image1,:image2,:image3,:description,:type,:target,:workRange,:pay_method,:startY,:startM,:startD,:deadlineY,:deadlineM,:deadlineD,:schedule,:url,:u_id,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":c_name", $pc_name, PDO::PARAM_STR );
$stmt->bindParam ( ":p_name", $p_name, PDO::PARAM_STR );
$stmt->bindParam ( ":pay", $pay, PDO::PARAM_STR );
$stmt->bindParam ( ":image1", $fn01, PDO::PARAM_STR );
$stmt->bindParam ( ":image2", $fn02, PDO::PARAM_STR );
$stmt->bindParam ( ":image3", $fn03, PDO::PARAM_STR );
$stmt->bindParam ( ":description", $p_desc, PDO::PARAM_STR );
$stmt->bindParam ( ":type", $p_type, PDO::PARAM_STR );
$stmt->bindParam ( ":target", $target, PDO::PARAM_STR );
$stmt->bindParam ( ":workRange", $workRange, PDO::PARAM_STR );
$stmt->bindParam ( ":pay_method", $pPay_methodDB, PDO::PARAM_STR );
$stmt->bindParam ( ":startY", $es_year, PDO::PARAM_STR );
$stmt->bindParam ( ":startM", $es_month, PDO::PARAM_STR );
$stmt->bindParam ( ":startD", $es_day, PDO::PARAM_STR );
$stmt->bindParam ( ":deadlineY", $ed_year, PDO::PARAM_STR );
$stmt->bindParam ( ":deadlineM", $ed_month, PDO::PARAM_STR );
$stmt->bindParam ( ":deadlineD", $ed_day, PDO::PARAM_STR );
$stmt->bindParam ( ":schedule", $schedule, PDO::PARAM_STR );
$stmt->bindParam ( ":url", $p_url, PDO::PARAM_STR );
$stmt->bindParam ( ":u_id", $p_u_id, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">
    <meta name="author" content="CIRCUS">
    <meta name="description" content="「CIRCUS」はクリエイターやアーティストに特化したクラウドソーシングサービスです。作品やパフォーマンスなど幅広いジャンルの商品を簡単に売り買いできます。">
		<title>CIRCUS</title>
    <link rel="icon" type="../image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" type="../image/png" href="../images/apple-touch-icon-180x180.png">
    <link rel="icon" type="../image/png" href="icon-192x192.png">
    <link href="../css/destyle.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/about.css" rel="stylesheet">
    <link href="../css/service.css" rel="stylesheet">
    <link href="../css/news.css" rel="stylesheet">
    <link href="../css/eventPage.css" rel="stylesheet">
    <link href="../css/eventApp.css" rel="stylesheet">
    <link href="../css/contact.css" rel="stylesheet">
    <link href="../css/signUp.css" rel="stylesheet">
    <link href="../css/gift.css" rel="stylesheet">
    <link href="../css/mypage.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  </head>
  <body id="top">
    <div class="wrapper adminGWrapper">
      <header class="headButtons">
        <h1 class="logoButton"><a href="../index.php"><img src="../images/home_button.png" alt="circus Website"></a></h1>
        <div class="mcButtonArea">
					<?php
						if (isset($_SESSION['user'])) {
							echo '<a href="index.php" class="mcButtons mypageButton">マイページ</a>';
						}
					?>
					<!-- <a href="../gifts/cartIn.php" class="mcButtons cartButton">買い物かご</a> -->
        </div>
        <div class="lsButtonArea">
          <div class="loBox">
            <button class="lsButtons l">ログイン</button>
            <?php
            if (isset($_SESSION['user'])) {
              echo '<form action="../logout.php" method="post" id="logout">
              <input type="submit" name="logout" id="logout_form" value="ログアウト">
              </form>';
            }
            ?>
          </div>
          <a href="../signup/index.php" class="lsButtons s">新規登録</a>
        </div>
        <button type="button" id="hamburger" class="hamburger hamFrame" aria-controls="headerNav" aria-expanded="false">
          <div class="line"></div>
          <div class="menu">MENU</div>
        </button><!-- /.hamberger -->
      </header><!-- /header -->
      <nav class="headerNav">
        <ul>
          <li><a href="../about.php">About</a></li>
          <li><a href="../service.php">Service</a></li>
          <li><a href="../news.php">News</a></li>
          <li><a href="../gifts/index.php">Gifts</a></li>
          <li><a href="../projects/index.php">Projects</a></li>
          <li><a href="../contact/index.php">Contact</a></li>
        </ul>
      </nav><!-- /.headerNav -->
      <div class="blackBack"></div><!-- /.blackBack -->
      <div class="modal">
        <button class="close"><img src="../images/grayClose.png" alt="close_button"></button>
        <div class="loginForm">
          <h2>ログイン</h2>
          <form action="../mypage/index.php" method="post">
            <label>メールアドレス<br>
            <input type="email" name="email" autocomplete="email" placeholder="例）info@circus.co.jp" id="leForm"></label>
            <label>パスワード<br>
            <input type="password" name="password" placeholder="パスワード" id="lpForm"></label>
            <input type="submit" name="login" value="ログイン" id="loginButton">
            <p class="signupGuide">新規会員登録は<a href="../signup/index.php">こちら</a></p>
          </form>
        </div><!-- /.loginForm -->
      </div><!-- /.modal -->
      <main>
        <div class="mypage cWrapper">
					<h2 class="sectionTitle">Projects登録</h2>
          <p>Projects登録手続きが完了いたしました。</p>
          <a href="index.php" class="tapButton">MyPageへ</a>
        </div><!-- /.mypage cWrapper-->
      </main><!-- /main -->
      <footer>
        <nav class="footerNav">
          <ul>
            <li><a href="../about.php">About</a></li>
            <li><a href="../service.php">Service</a></li>
            <li><a href="../news.php">News</a></li>
            <li><a href="../gifts/index.php">Gifts</a></li>
            <li><a href="../projects/index.php">Projects</a></li>
            <li><a href="../contact/index.php">Contact</a></li>
          </ul>
        </nav>
        <p id="pageTop"><a href="#top"></a></p>
        <p id="copyRight"><small>Copyright&copy; CIRCUS </small></p>
      </footer><!-- /footer -->
    </div><!-- /.wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>

<?php
	unset($_SESSION['pc_name']);
	unset($_SESSION['p_name']);
	unset($_SESSION['pay']);
	unset($_SESSION['p_desc']);
	unset($_SESSION['p_type']);
	unset($_SESSION['target']);
	unset($_SESSION['workRange']);
	unset($_SESSION['pPay_method']);
	unset($_SESSION['es_year']);
	unset($_SESSION['es_month']);
	unset($_SESSION['es_day']);
	unset($_SESSION['ed_year']);
	unset($_SESSION['ed_month']);
	unset($_SESSION['ed_day']);
	unset($_SESSION['schedule']);
	unset($_SESSION['p_url']);
	unset($_SESSION['error']);
?>