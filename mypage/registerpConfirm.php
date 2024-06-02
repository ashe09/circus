<?php
//session_start();
//require_once ("dbConnect.php");
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
					<h2 class="sectionTitle">Projects登録</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ変更するボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>カテゴリー</dt>
              <dd>Graphic</dd>
            </dl>
             <dl>
              <dt>Projectsタイトル</dt>
              <dd>Projectsタイトル</dd>
            </dl>
            <dl>
              <dt>支払い価格</dt>
              <dd>10,000円</dd>
            </dl>
            <dl>
              <dt>Projects画像1</dt>
              <dd>projectsPhoto1.jpg</dd>
            </dl>
            <dl>
              <dt>Projects画像2</dt>
              <dd>projectsPhoto2.jpg</dd>
            </dl>
            <dl>
              <dt>Projects画像3</dt>
              <dd>projectsPhoto3.jpg</dd>
            </dl>
            <dl>
              <dt>Projectsの詳細</dt>
              <dd  class="content">詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。詳細な説明。</dd>
            </dl>
            <dl>
              <dt>タイプ</dt>
              <dd>絵画</dd>
            </dl>
            <dl>
              <dt>ターゲット</dt>
              <dd>20代〜30代</dd>
            </dl>
            <dl>
              <dt>素材</dt>
              <dd>キャンバス・油彩</dd>
            </dl>
            <dl>
              <dt>作業範囲</dt>
              <dd>依頼開始〜納品完了まで</dd>
            </dl>
            <dl>
              <dt>支払い方法</dt>
              <dd>振り込み(Project完了後)</dd>
            </dl>
            <dl>
              <dt>エントリー開始</dt>
              <dd>2024年10月1日</dd>
            </dl>
            <dl>
              <dt>エントリー締切</dt>
              <dd>2024年10月10日</dd>
            </dl>
            <dl>
              <dt>スケジュール</dt>
              <dd class="content">2024年10月17日(依頼開始)〜2024年12月1日(納品完了)</dd>
            </dl>
            <dl>
              <dt>サイトURL</dt>
              <dd>https://www.yamada.com</dd>
            </dl>
            <div class="submitItem"> 
              <a href="index.php" class="backButton">戻 る</a>
              <form action="registerpComplete.php" method="post">
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