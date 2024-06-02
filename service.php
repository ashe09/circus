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
    <link href="css/service.css" rel="stylesheet">
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
        <section class="service">
          <h2 class="sectionTitle">Service</h2>
          <h3 class="serviceSubhead">会員登録すると...</h3>
          <div class="serviceWrap">
            <div class="serviceItem">
              <p class="serviceImg">
                <img src="images/giftsBox.svg" alt="Giftsの売り買い">
              </p>
              <h3 class="subhead">Giftsの売り買い</h3>
              <p class="serviceText">オンラインのマーケットで様々なジャンルのクリエイターたちがArtistsとして登録し、作品やスキル、パフォーマンスなどをGifts（商品）として出品できます。Partnersは気に入ったGiftsを購入することができます。
              </p>
            </div><!-- /.serviceItem -->
            <div class="serviceItem">
              <p class="serviceImg">
                <img src="images/pc.svg" alt="仕事の発注と提案">
              </p>
              <h3 class="subhead">仕事の発注と提案</h3>
              <p class="serviceText">PartnersはArtistsに対して仕事やプロジェクトの依頼を提案し、受注できるクリエイターを気軽に探すことができます。またArtistsが使用できる制作場所や物品をGifts（商品）として出品することも可能です。
              </p>
            </div><!-- /.serviceItem -->
            <div class="serviceItem">
              <p class="serviceImg">
              <img src="images/shakeHands.svg" alt="Artistsの活動サポート">
              </p>
              <h3 class="subhead">Artistsの活動サポート</h3>
              <p class="serviceText">あらゆるArtistsが活躍できるよう様々なイベントやセミナーを企画します。また海外での活動や留学を検討しているクリエイターには有料のサポートサービスも行なっています。
              </p>
            </div><!-- /.serviceItem -->
          </div><!-- /.serviceWrap -->
        </section><!-- /.service -->
        <section class="cases">
          <h2 class="sectionTitle">Cases</h2>
          <p class="subhead role">Artists</p>
          <div class="contentWrap">
            <div class="casesContent">
              <p class="casesImg"><img src="images/jewel.svg" alt="ジュエリーデザイナー"></p>
              <p class="users">ジュエリーデザイナー</p>
                <p class="aboutText">CIRCUSで自分の作品を販売したり仕事の依頼を受けたりして、自分のスキルで収入を得られるようになった。
                </p>
            </div>
            <div class="casesContent">
              <p class="casesImg"><img src="images/paint.svg" alt="画家"></p>
              <p class="users">画家</p>
              <p class="aboutText">個展の会場を探したり、大きな作品を制作するための場所を見つけるのに便利。
              </p>
            </div>
            <div class="casesContent">
              <p class="casesImg"><img src="images/music.svg" alt="ミュージシャン"></p>
              <p class="users">ミュージシャン</p>
              <p class="aboutText">ライブのチケット販売に使える。CIRCUSで知り合ったArtistsやPartnersともコラボしてライブを開催している。
              </p>
            </div>
          </div><!-- /.contentWrap -->
          <p class="subhead role">Partners</p>
          <div class="contentWrap">
            <div class="casesContent">
              <p class="casesImg"><img src="images/eventer.svg" alt="イベンター"></p>
              <p class="users">イベンター</p>
              <p class="aboutText">プロジェクトを提案すると、参加してくれるArtistsが短時間でたくさん見つかるので効率がいい。
              </p>
            </div>
            <div class="casesContent">
              <p class="casesImg"><img src="images/buyer.svg" alt="アートバイヤー"></p>
              <p class="users">アートバイヤー</p>
              <p class="aboutText">クリエイターに特化しているので、ほしい作品やスキルを持っているArtistsを見つけやすい。
              </p>
            </div>
            <div class="casesContent">
              <p class="casesImg"><img src="images/owner.svg" alt="ショップオーナー"></p>
              <p class="users">ショップオーナー</p>
              <p class="aboutText">店では売れないアンティーク品などが、撮影の美術品としてよく売れる。
              </p>
            </div>
          </div><!-- /.contentWrap -->
        </section><!-- /.cases -->
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