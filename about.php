<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
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
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" type="image/png" href="images/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="icon-192x192.png">
    <link href="css/destyle.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  </head>
  <body id="top">
    <div class="wrapper">
      <header class="headButtons">
        <h1 class="logoButton"><a href="index.php"><img src="images/home_button.png" alt="circus Website"></a></h1>
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
              <img src="images/aboutImg.png" alt="circus logo">
            </p>
            <h3 class="aboutSubhead">あらゆるArtistsが集う<span class="newLine">インタラクティブなステージ</span></h3>
            <div class="contentWrap">
              <div class="aboutContent">
                <p class="subhead role">Artists</p>
                <p class="aboutText">グラフィック・プロダクト・Web・ファッション・造形・彫刻・絵画・映像・CG・写真・音楽などあらゆるジャンルのクリエイターの方はArtists（出品者）として登録し、作品・スキル・パフォーマンスなどをGifts（商品）として販売することができます。
                </p>
              </div>
              <div class="aboutContent">
                <p class="subhead role">Partners</p>
                <p class="aboutText">ArtistsのGifts（商品）を購入または仕事を依頼したい方はPartners（支援者）として登録し、気軽にマーケットサービスを利用することができます。購入や仕事の依頼のほかArtistsが活動するための会場や制作場所の提供、物品の貸し出しなど様々な形で支援することができます。
                </p>
              </div>
            </div><!-- /.contentWrap -->
          </div><!-- /.aboutWrap -->
        </section><!-- /.about -->
        <section class="concept">
          <h2 class="sectionTitle">Concept</h2>
          <div class="aboutWrap">
            <h3 class="aboutSubhead">Artistsが才能を発揮できる場所<br>×<br>アートをエンターテイメント<span class="newLine">として楽しむ場所</span></h3>
            <div class="contentWrap">
              <div class="aboutContent conceptContent">
                <p class="aboutText">CIRCUSは駆け出しのアーティストたちが個性と才能を発揮し、作品やスキルで収入を得られるようサポートすることを目的としています。<br>
                また多くの人々が様々なジャンルのアートをエンターテイメントショーとして楽しみながら支援できる空間を提供します。サーカスを見るときのようなワクワク感を届けるという想いを込めて「CIRCUS」を創業しました。
                </p>
              </div>
            </div><!-- /.contentWrap -->
          </div><!-- /.aboutWrap -->
        </section><!-- /.concept -->
      </main><!-- /main -->
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