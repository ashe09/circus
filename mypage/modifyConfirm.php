<?php
session_start();
session_regenerate_id( TRUE );
require_once ("dbConnect.php");
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");


$_POST = checkInput( $_POST );

$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$ruby = isset($_POST['ruby']) ? $_POST['ruby'] : NULL;
$u_name = isset($_POST['u_name']) ? $_POST['u_name'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$pass = isset($_POST['password']) ? $_POST['password'] : NULL;
$password_hash = password_hash($pass, PASSWORD_DEFAULT);
$role = isset($_POST['role']) ? $_POST['role'] : NULL;
$postcode = isset($_POST['postcode']) ? $_POST['postcode'] : NULL;
$add = isset($_POST['add']) ? $_POST['add'] : NULL;
$tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
$file = isset($_FILES['photo']) ? $_FILES['photo'] : NULL;
$file_name = $file['name'];
$ex = strtolower(mb_strrchr($file_name,'.',FALSE));
$profile = isset($_POST['profile']) ? $_POST['profile'] : NULL;
$url = isset($_POST['url']) ? $_POST['url'] : NULL;

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
$profile = str_replace(array('-', 'ー', '−', '―', '‐'), '-', $profile);
$profile = mb_convert_kana($profile,"a");
$profile = mb_convert_kana($profile,"K");
$url = trim($url);


$error = array();
if ($name == '') {
  $error['name'] = '　＊お名前を入力してください。';
}
if ($ruby == '') {
  $error['ruby'] = '　＊ふりがなを入力してください。';
}
if ($u_name == '') {
  $error['u_name'] = '　＊ユーザー名を入力してください。';
}
if ($email == '') {
  $error['email'] = '　＊メールアドレスを入力してください。';
} else {
  $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
  if (!preg_match( $pattern, $email )) {
    $error['email'] = '　＊メールアドレスの形式が正しくありません。';
  }
  $member = $db->prepare('SELECT COUNT(email) as cnt FROM users WHERE email=?');
  $member->execute(array(
      $_POST['email']
  ));
  $record = $member->fetch();
  if ($record['cnt'] > 0) {
      $error['email'] = '　＊このメールアドレスは既に使用されています。';
  }
}
if ($password_hash == '') {
  $error['password'] = '　＊パスワードを入力してください。';
}
if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,30}+\z/i', $_POST['password'])) {
  $error['password'] = '　＊パスワードは半角英数字をそれぞれ1文字以上含んだ5文字以上30文字以内で設定してください。';
}
if ($postcode == "") {
  $error['postcode'] = '　＊郵便番号を入力してください。';
}
if ($postcode != '' && !preg_match('/^(\d{3}-{1}\d{4})|(\d{7})$/', $postcode)) {
  $error['postcode'] = '　＊郵便番号の形式が正しくありません。';
}
if ($add == "") {
  $error['add'] = '　＊ご住所を入力してください。';
}
if ($tel != '' && preg_match( '/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $tel ) == 0 ) {
  $error['tel'] = '　＊電話番号の形式が正しくありません。';
}

$max_size = 1900*1200;
if (!empty($file_name)) {
  if(($file['type']!='image/jpeg' 
	&& $file['type']!='image/pjpeg'
	&& $file['type']!='image/png'
	&& $file['type']!='image/gif')
	|| ($ex!=".jpg" && $ex!=".jepg"  && $ex!=".png" && $ex!=".gif" )){
    unlink($file['tmp_name']);
    $error['photo'] = '　＊画像の形式が正しくありません。';
  } elseif ($file['size']>$max_size) {
    unlink($file['tmp_name']);
    $error['photo'] = '　＊アップロードできるサイズを超えています。';
  } else {
    $directory = "original_uphoto";
    $directory_thum = "thumb_uphoto";
    $app_datetime=date('YmdHis');
    $fn=$app_datetime.$file['name'];
 
    move_uploaded_file($file['tmp_name'],'./original_uphoto/'.$fn);
  
    $file1 = "./original_uphoto/$fn";
    $file2 = "./thumb_uphoto/$fn";
  
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
  
    $out = imagecreatetruecolor($width, $height);    //キャンバスを用意する
    imagealphablending($out, false);
    imagesavealpha($out, true);
    ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$size[0],$size[1]);   //画像をリサイズする
  
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

if (600 < mb_strlen($profile)) {
  $error['profile'] = '　＊内容は600字以内で入力してください。';
}
if ($url != '' && preg_match( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $url ) == 0 ) {
  $error['url'] = '　＊urlの形式が正しくありません。';
}

$_SESSION["name"] = $name;
$_SESSION["ruby"] = $ruby;
$_SESSION["u_name"] = $u_name;
$_SESSION["email"] = $email;
$_SESSION["password"] = $password_hash;
$_SESSION["role"] = $role;
$_SESSION["postcode"] = $postcode;
$_SESSION["add"] = $add;
$_SESSION["tel"] = $tel;
$_SESSION["photo"] = $file_name;
$_SESSION["fn"] = $fn;
$_SESSION["profile"] = $profile;
$_SESSION["url"] = $url;
$_SESSION["error"] = $error;

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">
		<title>CIRCUS</title>
    <meta name="author" content="CIRCUS">
    <meta name="description" content="「CIRCUS」はクリエイターやアーティストに特化したクラウドソーシングサービスです。作品やパフォーマンスなど幅広いジャンルの商品を簡単に売り買いできます。">
    <link rel="canonical" href="https://www.circus-creativeworld.com">
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
					<h2 class="sectionTitle">Profile変更</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ変更するボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
          <dl>
              <dt>お名前</dt>
              <dd><?php echo $name; ?></dd>
            </dl>
            <dl>
              <dt>ふりがな</dt>
              <dd><?php echo $ruby; ?></dd>
            </dl>
            <dl>
              <dt>ユーザー名</dt>
              <dd><?php echo $u_name; ?></dd>
            </dl>
            <dl>
              <dt>メールアドレス</dt>
              <dd><?php echo $email; ?></dd>
            </dl>
            <dl>
              <dt>パスワード</dt>
              <dd>表示されません。</dd>
            </dl>
            <dl>
              <dt>どちらで登録しますか？</dt>
              <dd><?php echo $role; ?></dd>
            </dl>
            <dl>
              <dt>郵便番号</dt>
              <dd><?php echo $postcode; ?></dd>
            </dl>
            <dl>
              <dt>住所</dt>
              <dd><?php echo $add; ?></dd>
            </dl>
            <dl>
              <dt>電話番号</dt>
              <dd><?php echo $tel; ?></dd>
            </dl>
            <dl>
              <dt>プロフィール写真</dt>
              <dd><?php echo $file_name; ?></dd>
            </dl>
            <dl>
              <dt>プロフィール</dt>
              <dd class="content"><?php echo $profile; ?></dd>
            </dl>
            <dl>
              <dt>サイトURL</dt>
              <dd><?php echo $url; ?></dd>
            </dl>
            <div class="submitItem"> 
              <a href="index.php" class="backButton">戻 る</a>
              <form action="modifyComplete.php" method="post">
                <input type="submit" name="submit" value="変更する" id="submitButton">
              </form><!-- /form -->
            </div><!-- /.submitItem -->
          </div><!-- /.confirmArea -->
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