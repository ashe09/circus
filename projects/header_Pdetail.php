<?php
session_start();
session_regenerate_id( TRUE );
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
    <link href="../css/gift.css" rel="stylesheet">
    <link href="../css/giftsDetail.css" rel="stylesheet">
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
							echo '<a href="../mypage/index.php" class="mcButtons mypageButton">マイページ</a>';
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
          <li><a href="index.php">Projects</a></li>
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
      <div class="categoryAreaBack"></div><!-- /.categoryAreaBack -->
      <div class="categoryArea">
        <button class="categorySelect02 cselect"><i class="fas fa-user-friends"></i>Category</button>
        <nav class="categoryMenu02 cmenu">
          <button class="categoryClose"><img src="../images/whiteClose.png" alt="close_button"></button>
          <ul>
            <li><a href="#"><i class="fas fa-pencil-alt"></i>Graphic</a></li>
            <li><a href="#"><i class="fas fa-box-open"></i>Product</a></li>
            <li><a href="#"><i class="fas fa-laptop"></i>Web</a></li>
            <li><a href="#"><i class="fas fa-tshirt"></i>Fashion</a></li>
            <li><a href="#"><i class="fas fa-music"></i>Music</a></li>
            <li><a href="#"><i class="fas fa-palette"></i>Paint</a></li>
            <li><a href="#"><i class="fas fa-hammer"></i>Sculpture</a></li>
            <li><a href="#"><i class="fas fa-video"></i>Movie</a></li>
            <li><a href="#"><i class="fas fa-camera"></i>Photo</a></li>
            <li><a href="#"><i class="fas fa-desktop"></i>CG</a></li>
          </ul>
        </nav>
      </div><!-- /.categoryArea -->