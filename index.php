<?php
session_start();
session_regenerate_id( TRUE );
require_once ("dbConnect.php");
ini_set('display_errors', 0);
header("X-FRAME-OPTIONS: SAMEORIGIN");

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
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
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" type="image/png" href="images/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="icon-192x192.png">
    <link href="css/destyle.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  </head>
  <body id="top">
    <div class="wrapper">
      <header class="headButtons headertop560">
        <div class="mcButtonArea">
					<?php
						if (isset($_SESSION['user'])) {
							echo '<a href="mypage/index.php" class="mcButtons mypageButton">マイページ</a>';
						}
					?>
					<!-- <a href="gifts/cartIn.php" class="mcButtons cartButton">買い物かご</a> -->
        </div>
        <div class="lsButtonArea">
          <div class="loBox">
            <button class="lsButtons l">ログイン</button>
            <?php
            if (isset($_SESSION['user'])) {
              echo '<form action="logout.php" method="post" id="logout">
              <input type="submit" name="logout" id="logout_form" value="ログアウト">
              </form>';
            }
            ?>
          </div>
          <a href="signup/index.php" class="lsButtons s">新規登録</a>
        </div>
        <button type="button" id="hamburger" class="hamburger hamFrame" aria-controls="headerNav" aria-expanded="false">
          <div class="line"></div>
          <div class="menu">MENU</div>
        </button><!-- /.hamberger -->
      </header><!-- /header -->
      <div class="keyVwrap">
        <h1 class="h1circus"><img src="images/top_logo.png" alt="circus logo"></h1>
        <img class="layer" src="images/layer.jpg" alt="">
        <P class="keyVwrapImg">
          <img src="images/keyImg1.jpg" alt="">
          <img src="images/keyImg2.jpg" alt="">
          <img src="images/keyImg3.jpg" alt="">
          <img src="images/keyImg4.jpg" alt="">
        </P>
      </div><!-- /.keyVwrap -->
      <nav class="headerNav">
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="service.php">Service</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="gifts/index.php">Gifts</a></li>
          <li><a href="projects/index.php">Projects</a></li>
          <li><a href="contact/index.php">Contact</a></li>
        </ul>
      </nav><!-- /.headerNav -->
      <div class="blackBack"></div><!-- /.blackBack -->
      <div class="modal">
        <button class="close"><img src="images/grayClose.png" alt="close_button"></button>
        <div class="loginForm">
          <h2>ログイン</h2>
          <form action="mypage/index.php" method="post">
            <input type="email" name="email" autocomplete="email" placeholder="例）info@circus.co.jp" id="leForm" required></label>
            <input type="password" name="password" placeholder="パスワード" id="lpForm" required></label>
            <input type="submit" name="login" value="ログイン" id="loginButton">
            <p class="signupGuide">新規会員登録は<a href="signup/index.php">こちら</a></p>
          </form>
        </div><!-- /.loginForm -->
      </div><!-- /.modal -->
      <main>
        <section class="about">
          <h2 class="sectionTitle">About</h2>
          <div class="aboutWrap">
            <p class="aboutImg">
              <img src="images/top_about.png" alt="circus">
            </p>
            <div class="aboutContent">
              <h3 class="aboutSubhead">あらゆるArtistsが集う<span class="newLine">インタラクティブなステージ</span></h3>
              <p class="aboutText">CIRCUS（サーカス）とは、あらゆるジャンルのArtists（出品者）が作品・スキル・パフォーマンスなどを販売するクリエイター特化型のマーケットサービスです。<br>
              Partners（支援者）は購入や仕事の依頼のほか会場や制作場所の提供、物品の貸し出しなど様々な形で支援することができます。
              </p>
            </div>
          </div><!-- /.aboutWrap -->
          <a href="about.php" class="tapButton">About</a>
        </section><!-- /.about -->
        <section class="service">
          <h2 class="sectionTitle">Service</h2>
          <div class="serviceWrap">
            <div class="serviceItem">
              <p class="serviceImg">
                <img src="images/giftsBox.svg" alt="Giftsの売り買い">
              </p>
              <h3 class="subhead">Giftsの売り買い</h3>
              <p class="serviceText">オンラインのマーケットでArtistsは作品やスキルをGifts（商品）として出品し、PartnersはGiftsを気軽に購入できます。
              </p>
            </div><!-- /.serviceItem -->
            <div class="serviceItem">
              <p class="serviceImg">
                <img src="images/pc.svg" alt="仕事の発注と提案">
              </p>
              <h3 class="subhead">仕事の発注と提案</h3>
              <p class="serviceText">PartnersはArtistsに対して仕事やプロジェクトを依頼したり提案したりすることができます。
              </p>
            </div><!-- /.serviceItem -->
            <div class="serviceItem">
              <p class="serviceImg">
                <img src="images/shakeHands.svg" alt="Artistsの活動サポート">
              </p>
              <h3 class="subhead">Artistsの活動サポート</h3>
              <p class="serviceText">あらゆるArtistsが活躍できるよう様々なイベントやセミナーを企画し、活動をサポートします。
              </p>
            </div><!-- /.serviceItem -->
          </div><!-- /.serviceWrap -->
          <a href="service.php" class="tapButton">Service</a>
        </section><!-- /.service -->
      </main><!-- /main -->
      <div class="signup">
          <h2 class="sectionTitle">Sign up</h2>
          <p>CIRCUSに入場してみませんか？</p>
          <a href="signup/index.php" class="tapButton last">新規登録 (無料)</a>
      </div><!-- /.signup -->
      <footer>
        <nav class="footerNav">
          <ul>
            <li><a href="about.php">About</a></li>
            <li><a href="service.php">Service</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="gifts/index.php">Gifts</a></li>
            <li><a href="projects/index.php">Projects</a></li>
            <li><a href="contact/index.php">Contact</a></li>
          </ul>
        </nav>
        <p id="pageTop"><a href="#top"></a></p>
        <p id="copyRight"><small>Copyright&copy; CIRCUS </small></p>
      </footer><!-- /footer -->
    </div><!-- /.wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <noscript>
      <style>
      section {
        opacity: 1;
			}
      </style>
    </noscript>
  </body>
</html>