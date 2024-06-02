<?php
//session_start();
//session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");
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
					<h2 class="sectionTitle">Gifts登録</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ変更するボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>カテゴリー</dt>
              <dd>Graphic</dd>
            </dl>
             <dl>
              <dt>Giftsタイトル</dt>
              <dd>商品名</dd>
            </dl>
            <dl>
              <dt>販売価格</dt>
              <dd>5,000円</dd>
            </dl>
            <dl>
              <dt>Gifts画像1</dt>
              <dd>giftsPhoto1.jpg</dd>
            </dl>
            <dl>
              <dt>Gifts画像2</dt>
              <dd>giftsPhoto2.jpg</dd>
            </dl>
            <dl>
              <dt>Gifts画像3</dt>
              <dd>giftsPhoto3.jpg</dd>
            </dl>
            <dl>
              <dt>Giftsの詳細</dt>
              <dd class="content">詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。</dd>
            </dl>
            <dl>
              <dt>タイプ</dt>
              <dd>絵画</dd>
            </dl>
            <dl>
              <dt>サイズ</dt>
              <dd>50cm×50cm</dd>
            </dl>
            <dl>
              <dt>素材</dt>
              <dd>キャンバス・油彩</dd>
            </dl>
            <dl>
              <dt>代金受け取り方法</dt>
              <dd>振り込み</dd>
            </dl>
            <dl>
              <dt>発送方法</dt>
              <dd>ヤマト運輸</dd>
            </dl>
            <dl>
              <dt>送料</dt>
              <dd>3,000円</dd>
            </dl>
            <dl>
              <dt>サイトURL</dt>
              <dd>https://www.yamada.com</dd>
            </dl>
            <div class="submitItem"> 
              <a href="index.php" class="backButton">戻 る</a>
              <form action="registergComplete.php" method="post">
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




<?php

$gc_name = h($_POST["gc_name"]);
$g_name = h($_POST["gc_name"]);
$price = h($_POST["gc_name"]);
$image01 = isset($_FILES['image01']) ? $_FILES['image01'] : NULL;
$image01_name = $image01['name'];
$image01_ex = strtolower(mb_strrchr($image01_name,'.',FALSE));//アップロードされたファイル名を小文字半角に変換(統一)
$image02 = isset($_FILES['image02']) ? $_FILES['image02'] : NULL;
$image02_name = $image02['name'];
$image02_ex = strtolower(mb_strrchr($image02_name,'.',FALSE));//アップロードされたファイル名を小文字半角に変換(統一)
$image03 = isset($_FILES['image03']) ? $_FILES['image03'] : NULL;
$image03_name = $image03['name'];
$image03_ex = strtolower(mb_strrchr($image03_name,'.',FALSE));//アップロードされたファイル名を小文字半角に変換(統一)
$g_desc = isset($_POST['g_desc']) ? $_POST['g_desc'] : NULL;
$g_type = isset($_POST['g_type']) ? $_POST['g_type'] : NULL;
$size = isset($_POST['size']) ? $_POST['size'] : NULL;
$material = isset($_POST['material']) ? $_POST['material'] : NULL;
$pay_method = isset($_POST['pay_method']) ? $_POST['pay_method'] : NULL;
$delivery = isset($_POST['delivery']) ? $_POST['delivery'] : NULL;
$shipping_fee = isset($_POST['shipping_fee']) ? $_POST['shipping_fee'] : NULL;
$url = isset($_POST['url']) ? $_POST['url'] : NULL;

$g_name = trim($g_name);
$g_name = mb_convert_kana($g_name,"S");
$price = trim($price);
$price = mb_convert_kana($price,"n");
$price = number_format($price);
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
$shipping_fee = number_format($shipping_fee);
$url = trim($url);

$error = array();
if ($gc_name == '選択してください') {
  $error['gc_name'] = '　＊カテゴリーを入力してください。';
}
if ($g_name == '') {
  $error['g_name'] = '　＊タイトルを入力してください。';
}
if ($price == '') {
  $error['price'] = '　＊販売価格を入力してください。';
}
if ($price != '' || !preg_match("/[^0-9]/,/", $price)){
  $error['price'] = "　＊数字を入力してください。";
}
if ($g_desc == '') {
  $error['g_desc'] = '　＊詳細を入力してください。';
}
if ($g_type == '') {
  $error['g_type'] = '　＊タイプを入力してください。';
}
if (30 < mb_strlen($g_type)) {  //制御文字（タブ、復帰、改行を除く）でないことと文字数をチェック
  $error['g_type'] = '　＊タイプは30字以内で入力してください。';
}
if ($size == '') {
  $error['size'] = '　＊サイズを入力してください。';
}
if ($material == '') {
  $error['material'] = '　＊素材を入力してください。';
}
if ($pay_method == '') {
  $error['pay_method'] = '　＊代金受け取り方法を選択してください。';
}
if ($delivery == '') {
  $error['delivery'] = '　＊配送方法を選択してください。';
}
if ($shipping_fee == '') {
  $error['shipping_fee'] = '　＊送料を入力してください。';
}
if ($shipping_fee != '' || !preg_match("/[^0-9]/,/", $shipping_fee)){
  $error['shipping_fee'] = "　＊数字を入力してください。";
}
if ($url != '' && preg_match( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $url ) == 0 ) {
  $error['url'] = '　＊urlの形式が正しくありません。';
}

//画像データ以外のファイルアップロードの拒否
$max_size = 1900*1200;
//image01
if (!empty($image01_name)) {
  if(($image01['type']!='image/jpeg' 
	&& $image01['type']!='image/pjpeg'
	&& $image01['type']!='image/png'
	&& $image01['type']!='image/gif')
	|| ($image01_ex!=".jpg" && $image01_ex!=".jepg"  && $image01_ex!=".png" && $image01_ex!=".gif" )){
    unlink($image01['tmp_name']);
    $error['image'] = '　＊画像の形式が正しくありません。';
  } elseif ($image01['size']>$max_size) {
    unlink($image01['tmp_name']);
    $error['image'] = '　＊アップロードできるサイズを超えています。';
  } else {
    //アップロードされたファイルの保存用ディレクトリ（フォルダ）を指定
    $directory = "original_gphoto";
    //サムネイル保存用(アップロードされたファイルを小さくして保存する)ディレクトリを指定
    $directory_thum = "thumb_gphoto";
    $app_datetime=date('YmdHis');
    $fn01=$app_datetime.$image01['name'];
    //ディレクトリない時作る
    if(!is_dir($directory)){mkdir($directory);}
    if(!is_dir($directory_thum)){mkdir($directory_thum);}
    // $upload_file = "{$directory}{$file_name}";
    //指定ディレクトリに画像ファイルをアップロード(保存)
    move_uploaded_file($image01['tmp_name'],'./original_gphoto/'.$fn01);
  
    $file1 = "./original_gphoto/$fn01";
    $file2 = "./thumb_gphoto/$fn01";
  
    //指定ディレクトリから画像ファイルを読み込み
    //$motogazo=imagecreatefromjpeg("./gz_img/$fn");
    switch($image01_ex){
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
      // default:
      // 	print "<p>ファイル形式が異なります</p>";
      // 	exit;
    }
    //ファイルサイズを調べる  GetImageSizeは画像ファイルのサイズに関する情報を配列で取得するメソッド
    $size = getimagesize($file1);
    // list($w,$h)=getimagesize($file1);
    //$size[0]=幅　$size[1]=高さ　 $size[2]=タイプ　タイプ：1=gif  2=jpg,jpeg  3=png
  
    $width=200;   //アップロードされた全てのファイルのwidthを200に揃える
    $height = $size[1]*$width/$size[0];    //縦横の比率が変わらないようにするための計算。200のwidthに合わせてheightを調整。
    // $height=$w*200/$h;
  
    $out = imagecreatetruecolor($width, $height);    //キャンバスを用意する
    imagealphablending($out, false);
    imagesavealpha($out, true);
    ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$size[0],$size[1]);   //画像をリサイズする
    // ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$w,$h);   //画像をリサイズする
  
    switch ($image01_ex) {
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
      // default:
      //   print "<p>ファイル形式が異なります</p>";
      //   exit();
    }
    ImageDestroy($in);
    ImageDestroy($out);
  } 
}

//image02
if (!empty($image02_name)) {
  if(($image02['type']!='image/jpeg' 
	&& $image02['type']!='image/pjpeg'
	&& $image02['type']!='image/png'
	&& $image02['type']!='image/gif')
	|| ($image02_ex!=".jpg" && $image02_ex!=".jepg"  && $image02_ex!=".png" && $image02_ex!=".gif" )){
    unlink($image02['tmp_name']);
    $error['image'] = '　＊画像の形式が正しくありません。';
  } elseif ($image02['size']>$max_size) {
    unlink($image02['tmp_name']);
    $error['image'] = '　＊アップロードできるサイズを超えています。';
  } else {
    //アップロードされたファイルの保存用ディレクトリ（フォルダ）を指定
    $directory = "original_gphoto";
    //サムネイル保存用(アップロードされたファイルを小さくして保存する)ディレクトリを指定
    $directory_thum = "thumb_gphoto";
    $app_datetime =date('YmdHis');
    $fn02 = $app_datetime.$image02['name'];
    //ディレクトリない時作る
    if(!is_dir($directory)){mkdir($directory);}
    if(!is_dir($directory_thum)){mkdir($directory_thum);}
    // $upload_file = "{$directory}{$file_name}";
    //指定ディレクトリに画像ファイルをアップロード(保存)
    move_uploaded_file($image02['tmp_name'],'./original_gphoto/'.$fn02);
  
    $file1 = "./original_gphoto/$fn02";
    $file2 = "./thumb_gphoto/$fn02";
  
    //指定ディレクトリから画像ファイルを読み込み
    //$motogazo=imagecreatefromjpeg("./gz_img/$fn");
    switch($image02_ex){
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
      // default:
      // 	print "<p>ファイル形式が異なります</p>";
      // 	exit;
    }
    //ファイルサイズを調べる  GetImageSizeは画像ファイルのサイズに関する情報を配列で取得するメソッド
    $size = getimagesize($file1);
    // list($w,$h)=getimagesize($file1);
    //$size[0]=幅　$size[1]=高さ　 $size[2]=タイプ　タイプ：1=gif  2=jpg,jpeg  3=png
  
    $width=200;   //アップロードされた全てのファイルのwidthを200に揃える
    $height = $size[1]*$width/$size[0];    //縦横の比率が変わらないようにするための計算。200のwidthに合わせてheightを調整。
    // $height=$w*200/$h;
  
    $out = imagecreatetruecolor($width, $height);    //キャンバスを用意する
    imagealphablending($out, false);
    imagesavealpha($out, true);
    ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$size[0],$size[1]);   //画像をリサイズする
    // ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$w,$h);   //画像をリサイズする
  
    switch ($image02_ex) {
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
      // default:
      //   print "<p>ファイル形式が異なります</p>";
      //   exit();
    }
    ImageDestroy($in);
    ImageDestroy($out);
  } 
}

//image03
if (!empty($image03_name)) {
  if(($image03['type']!='image/jpeg' 
	&& $image03['type']!='image/pjpeg'
	&& $image03['type']!='image/png'
	&& $image03['type']!='image/gif')
	|| ($image03_ex!=".jpg" && $image03_ex!=".jepg"  && $image03_ex!=".png" && $image03_ex!=".gif" )){
    unlink($image03['tmp_name']);
    $error['image'] = '　＊画像の形式が正しくありません。';
  } elseif ($image03['size']>$max_size) {
    unlink($image03['tmp_name']);
    $error['image'] = '　＊アップロードできるサイズを超えています。';
  } else {
    //アップロードされたファイルの保存用ディレクトリ（フォルダ）を指定
    $directory = "original_gphoto";
    //サムネイル保存用(アップロードされたファイルを小さくして保存する)ディレクトリを指定
    $directory_thum = "thumb_gphoto";
    $app_datetime =date('YmdHis');
    $fn03 = $app_datetime.$image03['name'];
    //ディレクトリない時作る
    if(!is_dir($directory)){mkdir($directory);}
    if(!is_dir($directory_thum)){mkdir($directory_thum);}
    // $upload_file = "{$directory}{$file_name}";
    //指定ディレクトリに画像ファイルをアップロード(保存)
    move_uploaded_file($image03['tmp_name'],'./original_gphoto/'.$fn03);
  
    $file1 = "./original_gphoto/$fn03";
    $file2 = "./thumb_gphoto/$fn03";
  
    //指定ディレクトリから画像ファイルを読み込み
    //$motogazo=imagecreatefromjpeg("./gz_img/$fn");
    switch($image03_ex){
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
      // default:
      // 	print "<p>ファイル形式が異なります</p>";
      // 	exit;
    }
    //ファイルサイズを調べる  GetImageSizeは画像ファイルのサイズに関する情報を配列で取得するメソッド
    $size = getimagesize($file1);
    // list($w,$h)=getimagesize($file1);
    //$size[0]=幅　$size[1]=高さ　 $size[2]=タイプ　タイプ：1=gif  2=jpg,jpeg  3=png
  
    $width=200;   //アップロードされた全てのファイルのwidthを200に揃える
    $height = $size[1]*$width/$size[0];    //縦横の比率が変わらないようにするための計算。200のwidthに合わせてheightを調整。
    // $height=$w*200/$h;
  
    $out = imagecreatetruecolor($width, $height);    //キャンバスを用意する
    imagealphablending($out, false);
    imagesavealpha($out, true);
    ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$size[0],$size[1]);   //画像をリサイズする
    // ImageCopyResampled($out,$in,0,0,0,0,$width,$height,$w,$h);   //画像をリサイズする
  
    switch ($image03_ex) {
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
      // default:
      //   print "<p>ファイル形式が異なります</p>";
      //   exit();
    }
    ImageDestroy($in);
    ImageDestroy($out);
  } 
}

$_SESSION["gc_name"] = $gc_name;
$_SESSION["g_name"] = $g_name;
$_SESSION["price"] = $price;
$_SESSION["fn01"] = $fn01;
$_SESSION["fn02"] = $fn02;
$_SESSION["fn03"] = $fn03;
$_SESSION["g_desc"] = $g_desc;
$_SESSION["g_type"] = $g_type;
$_SESSION["size"] = $size;
$_SESSION["material"] = $material;
$_SESSION["pay_method"] = $pay_method;
$_SESSION["delivery"] = $delivery;
$_SESSION["shipping_fee"] = $shipping_fee;
$_SESSION["url"] = $url;
$_SESSION["error"] = $error;

if (count($error) > 0) {
//  header("Location: index.php");
//  exit();
}


date_default_timezone_set('Asia/Tokyo'); 

$gc_name = h($_SESSION["gc_name"]);
$g_name = h($_SESSION["g_name"]);
$price = h($_SESSION["price"]);
$fn01 = h($_SESSION["fn01"]);
$fn02 = h($_SESSION["fn02"]);
$fn03 = h($_SESSION["fn03"]);
$g_desc = h($_SESSION["g_desc"]);
$g_type = h($_SESSION["g_type"]);
$size = h($_SESSION["size"]);
$material = h($_SESSION["material"]);
$pay_method = h($_SESSION["pay_method"]);
$pay_method = implode(",",$pay_method);
$delivery = h($_SESSION["delivery"]);
$shipping_fee = h($_SESSION["shipping_fee"]);
$url = h($_SESSION["url"]);
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

$sql = "CREATE TABLE if not exists gifts (id int(11) not null primary key auto_increment,c_name varchar(30),g_name varchar(50),price int(11),image1 varchar(255),image2 varchar(255),image3 varchar(255),desc text,type varchar(30),size varchar(255),material varchar(255),pay_method varchar(50),delivery varchar(50),shipping_fee int(11),url text,create_date datetime)";
$stmt = $db->prepare ( $sql );
$stmt->execute ();

$sql = "INSERT INTO gifts (c_name,g_name,price,image1,image2,image3,desc,type,size,material,pay_method,delivery,shipping_fee,url,create_date) VALUES (:c_name,:g_name,:price,:image1,:image2,:image3,:desc,:type,:size,:material,:pay_method,:delivery,:shipping_fee,:url,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":c_name", $gc_name, PDO::PARAM_STR );
$stmt->bindParam ( ":g_name", $g_name, PDO::PARAM_STR );
$stmt->bindParam ( ":price", $price, PDO::PARAM_STR );
$stmt->bindParam ( ":image1", $fn01, PDO::PARAM_STR );
$stmt->bindParam ( ":image2", $fn02, PDO::PARAM_STR );
$stmt->bindParam ( ":image3", $fn03, PDO::PARAM_STR );
$stmt->bindParam ( ":desc", $g_desc, PDO::PARAM_STR );
$stmt->bindParam ( ":type", $g_type, PDO::PARAM_STR );
$stmt->bindParam ( ":size", $size, PDO::PARAM_STR );
$stmt->bindParam ( ":material", $material, PDO::PARAM_STR );
$stmt->bindParam ( ":pay_method", $pay_method, PDO::PARAM_STR );
$stmt->bindParam ( ":delivery", $delivery, PDO::PARAM_STR );
$stmt->bindParam ( ":shipping_fee", $shipping_fee, PDO::PARAM_STR );
$stmt->bindParam ( ":url", $url, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;

//$_SESSION = array();
//session_destroy();

?>