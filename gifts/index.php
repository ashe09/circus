<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$sql = "SELECT c_name, g_name, description, type FROM gifts WHERE id = 4";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
	$record[] = $row;
}

foreach ($record as $row) {
  $c_name = h($row["c_name"]);
  $g_name = h($row['g_name']);
  $description = h($row['description']);
  $type = h($row['type']);
}

$sql2 = "SELECT u.u_name, u.role, u.id, g.u_id FROM users u INNER JOIN gifts g ON u.id=g.u_id";
$stmt2 = $db->query ( $sql2 );

while($row2 = $stmt2 -> fetch()) {
	$record2[] = $row2;
}

foreach ($record2 as $row2) {
  $u_name = h($row2['u_name']);
  $role = h($row2['role']);
}

$sql3 = "SELECT c_name, g_name, description, type FROM gifts ORDER BY id DESC";
$stmt3 = $db->query ( $sql3 );

while($row3 = $stmt3 -> fetch()) {
	$record3[] = $row3;
}

foreach ($record3 as $row3) {
  $c_name1 = h($row3["c_name"]);
  $g_name1 = h($row3['g_name']);
  $description1 = h($row3['description']);
  $type1 = h($row3['type']);
}

$sql4 = "SELECT u.u_name, u.role, u.id, g.u_id FROM users u INNER JOIN gifts g ON u.id=g.u_id ORDER BY u.id DESC";
$stmt4 = $db->query ( $sql4 );

while($row4 = $stmt4 -> fetch()) {
	$record4[] = $row4;
}

foreach ($record4 as $row4) {
  $u_name1 = h($row4['u_name']);
  $role1 = h($row4['role']);
}

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
          <li><a href="index.php">Gifts</a></li>
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
      <div class="categoryAreaBack"></div><!-- /.categoryAreaBack -->
      <div class="categoryArea">
        <button class="categorySelect01 cselect"><i class="fas fa-gift"></i>Category</button>
        <nav class="categoryMenu01 cmenu">
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
      <main>
        <div class="gifts">
          <h2 class="sectionTitle">Gifts</h2>
          <div class="subheadBar">
            <h3>Artists</h3>
          </div>
          <div class="giftsWrap Artists">
						<div id="giftItem01" class="giftItem">
								<p class="giftImg">
                  <img src="../images/gifts1.jpg" alt="">
                  <span class="categoryTitle"><?php echo $c_name1; ?></span>
								</p>
							  <p class="giftTitle"><?php echo $g_name1; ?></p>
            </div><!-- /.giftItem -->
						<div id="giftItem02" class="giftItem">
								<p class="giftImg">
									<img src="../images/gifts2.jpg" alt="">
									<span class="categoryTitle">Fashion</span>
								</p>
              <p class="giftTitle">バッグ</p>
              <p class="attention">Sold out</p>
						</div><!-- /.giftItem -->
						<div id="giftItem03" class="giftItem">
								<p class="giftImg">
									<img src="../images/gifts3.jpg" alt="">
									<span class="categoryTitle">Music</span>
								</p>
              <p class="giftTitle">ライブチケット</p>
              <p class="attention">Sold out</p>
            </div><!-- /.giftItem -->
						<div id="giftItem04" class="giftItem">
								<p class="giftImg">
									<img src="../images/gifts4.jpg" alt="">
                  <span class="categoryTitle"><?php echo $c_name; ?></span>
                </p>
                <p class="giftTitle"><?php echo $g_name; ?></p>
						</div>
          </div><!-- /.giftItem -->

          <div class="subheadBar partners">
            <h3>Partners</h3>
          </div>
          <div class="giftsWrap Artists">
            <div id="giftItem05" class="giftItem">
                <p class="giftImg">
                  <img src="../images/gifts5.jpg" alt="">
                  <span class="categoryTitle">Photo</span>
                </p>
              <p class="giftTitle">展示会場</p>
              <p class="attention">Sold out</p>
            </div><!-- /.giftItem -->
            <div id="giftItem06" class="giftItem">
                <p class="giftImg">
                  <img src="../images/gifts6.jpg" alt="">
                  <span class="categoryTitle">Graphic</span>
                </p>
              <p class="giftTitle">デザインブック</p>
              <p class="attention">Sold out</p>
            </div><!-- /.giftItem -->
            <div id="giftItem07" class="giftItem">
                <p class="giftImg">
                  <img src="../images/gifts7.jpg" alt="">
                  <span class="categoryTitle">Paint</span>
                </p>
              <p class="giftTitle">作品制作場所</p>
              <p class="attention">Sold out</p>
            </div><!-- /.giftItem -->
            <div id="giftItem08" class="giftItem">
                <p class="giftImg">
                  <img src="../images/gifts8.jpg" alt="">
                  <span class="categoryTitle">Photo</span>
                </p>
              <p class="giftTitle">アンティークカメラ</p>
              <p class="attention">Sold out</p>
            </div><!-- /.giftItem -->
          </div><!-- /.giftsWrap -->

      		<div id="giftsmodal01" class="giftsmodal">
						<button class="close"><img src="../images/grayClose.png" alt="close_button"></button>
						<div class="giftsmodalItem">
							<p class="giftImg giftsmodalImg">
                  <img src="../images/gifts1.jpg" alt="">
              </p>
              <p class="giftTitle titleModal"><span class="categoryTitle02"><?php echo $c_name1; ?></span><?php echo $g_name1; ?></p>
							<dl class="giftsDesc">
								<dt class="modalLabel">タイプ</dt>
								<dd><?php echo $type1; ?></dd>
							</dl>
							<dl class="giftsDesc">
								<dt class="modalLabel">特 徴</dt>
								<dd><?php echo $description1; ?></dd>
							</dl>
							<dl class="giftsDesc">
								<dt class="modalLabel"><?php echo $role1; ?></dt>
								<dd><?php echo $u_name1; ?></dd>
							</dl>
							<a href="detail.php" class="tapButton">詳しく見る</a>
						</div><!-- /.giftsmodalItem -->
          </div><!-- /.giftsmodal -->

      		<div id="giftsmodal04" class="giftsmodal">
						<button class="close"><img src="../images/grayClose.png" alt="close_button"></button>
						<div class="giftsmodalItem">
							<p class="giftImg giftsmodalImg">
                  <img src="../images/gifts4.jpg" alt="">
              </p>
              <p class="giftTitle titleModal"><span class="categoryTitle02"><?php echo $c_name; ?></span><?php echo $g_name; ?></p>
							<dl class="giftsDesc">
								<dt class="modalLabel">タイプ</dt>
								<dd><?php echo $type; ?></dd>
							</dl>
							<dl class="giftsDesc">
								<dt class="modalLabel">特 徴</dt>
								<dd><?php echo $description; ?></dd>
              </dl>
							<dl class="giftsDesc">
								<dt class="modalLabel"><?php echo $role; ?></dt>
								<dd><?php echo $u_name; ?></dd>
							</dl>
							<a href="detail2.php" class="tapButton">詳しく見る</a>
						</div><!-- /.giftsmodalItem -->
          </div><!-- /.giftsmodal -->
          
          <div id="giftsmodal05" class="giftsmodal">
						<button class="close"><img src="../images/grayClose.png" alt="close_button"></button>
						<div class="giftsmodalItem">
							<p class="giftImg giftsmodalImg">
                  <img src="../images/gifts5.jpg" alt="">
              </p>
              <p class="giftTitle titleModal"><span class="categoryTitle02">Photo</span>展示会場</p>
							<dl class="giftsDesc">
								<dt class="modalLabel">タイプ</dt>
								<dd>場所提供</dd>
							</dl>
							<dl class="giftsDesc">
								<dt class="modalLabel">特 徴</dt>
								<dd>作品展示に使用できる会場をお貸しします。場所は神戸市中央区、期間は10月15日〜10月31日までです。ワイヤーレールや照明は予備がありますが、持ち込みも可能です。</dd>
							</dl>
							<dl class="giftsDesc">
								<dt class="modalLabel">Partners</dt>
								<dd>tanaka</dd>
							</dl>
							<a href="detail3.php" class="tapButton">詳しく見る</a>
						</div><!-- /.giftsmodalItem -->
          </div><!-- /.giftsmodal -->
          
          <div class="paginationWrapper giftPage">
            <nav class="pagination">
             <ul>
              <li><a href="#" class="pageBack pageNumber"><i class="fa fa-chevron-left"></i></a></li>
              <li><span aria-current="page" class="pageNumber current">1</span></li>
              <li><a href="#" class="pageNumber">2</a></li>
              <li><a href="#" class="pageNumber">3</a></li>
              <li><a href="#" class="pageNext pageNumber"><i class="fa fa-chevron-right"></i></a></li>
             </ul>
            </nav>
          </div><!-- /.paginationWrapper giftPage-->
        </div><!-- /.gifts -->
      </main><!-- /main -->
      <footer>
        <nav class="footerNav">
          <ul>
          <li><a href="../about.php">About</a></li>
          <li><a href="../service.php">Service</a></li>
          <li><a href="../news.php">News</a></li>
          <li><a href="index.php">Gifts</a></li>
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