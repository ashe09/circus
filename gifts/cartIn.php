<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;
$error_login = isset($error['login']) ? $error['login'] : NULL;

$_POST = checkInput( $_POST );
$cartIn = isset($_POST['cartIn']) ? $_POST['cartIn'] : NULL;
$giftsID = isset($_POST['giftsID']) ? $_POST['giftsID'] : NULL;
$selectQuantity = isset($_POST['selectQuantity']) ? $_POST['selectQuantity'] : NULL;

$sql = "SELECT * FROM gifts WHERE id=$giftsID";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
  $record[] = $row;
}

foreach ($record as $row) {
  $id = h($row['id']);
  $g_name = h($row['g_name']);
  $price = h($row['price']);
  $image1 = h($row['image1']);
  $shipping_fee = h($row['shipping_fee']);
}

$db = null;

$_SESSION['g_id'] = $id;
$_SESSION['g_name'] = $g_name;
$_SESSION['image1'] = $image1;
$_SESSION['price'] = $price;
$_SESSION['selectQuantity'] = $selectQuantity;
$_SESSION['shipping_fee'] = $shipping_fee;
$_SESSION['subTotal'] = $price*$selectQuantity;
$_SESSION['total'] = $price*$selectQuantity+$shipping_fee;

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
    <link href="../css/gift.css" rel="stylesheet">
    <link href="../css/giftsDetail.css" rel="stylesheet">
    <link href="../css/cartIn.css" rel="stylesheet">
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
					<!-- <a href="cartIn.php" class="mcButtons cartButton">買い物かご</a> -->
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
      <main>
        <div class="gifts">
          <h2 class="sectionTitle">Shopping Cart</h2>
          <div class="subheadBar">
            <h3>現在のお買い物</h3>
          </div>
          <div class="cartIn">
						<table class="cartTablePC">
							<tr>
								<th scope="col" class="cartpName first">商品名</th>
								<th scope="col" class="cartPrice first">価 格</th>
								<th scope="col" class="cartquantity first">数 量</th>
								<th scope="col" class="cartDelete first">削 除</th>
								<th scope="col" class="cartSubtotal first">小 計</th>
							</tr>
							<tr>
								<td class="tdpName"><img src="../mypage/original_gphoto/<?php echo $image1; ?>" alt="カートの商品画像" class="cartInImg"><a href="#" class="linkBrown"><?php echo $g_name; ?></a></td>
								<td class="tdUnitPrice">&yen;<?php echo number_format($price); ?>-</td>
								<td class="tdQuantity">
									<select id="quantity" name="cartQuantity">
                    <?php
                      for($i=1; $i<$selectQuantity+1; $i++) {
                        echo "<option value='$i' selected>".$i."</option>";
                      }
                    ?>
									</select>
								</td>
								<td class="tdDelete"><a href="#" class="linkBlue">削 除</a></td>
								<td class="tdSubtotal">&yen;<?php echo number_format($price*$selectQuantity); ?>-</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">送料</th>
								<td class="tdShipping" colspan="2">&yen;<?php echo number_format($shipping_fee); ?>-</td>
							</tr>
							<tr>
								<th scope="row" colspan="3" class="cartTotal">合計</th>
								<td class="tdTotal" colspan="2">&yen;<?php echo number_format($price*$selectQuantity+$shipping_fee); ?>-</td>
							</tr>
						</table><!-- /.cartTablePC -->

						<table class="cartTableST">
							<tr>
								<th scope="row" class="cartpName first">商品名</th>
								<td class="tdpName"><img src="../mypage/original_gphoto/<?php echo $image1; ?>" alt="カートの商品画像" class="cartInImg"><a href="#" class="linkBrown"><?php echo $g_name; ?></a></td>
							</tr>
							<tr>
								<th scope="row" class="cartPrice first">価 格</th>
								<td>&yen;<?php echo number_format($price); ?>-</td>
							</tr>
							<tr>
								<th scope="row" class="cartquantity first">数 量</th>
								<td class="tdQuantity">
									<select id="quantityST" name="quantity">
                    <?php
                      for($i=1; $i<$selectQuantity+1; $i++) {
                        echo "<option value='$i' selected>".$i."</option>";
                      }
                    ?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row" class="cartDelete first">削 除</th>
								<td><a href="#" class="linkBlue">削 除</a></td>
							</tr>
							<tr>
								<th scope="row" class="cartSubtotal first">小 計</th>
								<td class="tdSubtotal">&yen;<?php echo number_format($price*$selectQuantity); ?>-</td>
							</tr>
							<tr>
								<th scope="row">送料</th>
								<td>&yen;<?php echo number_format($shipping_fee); ?>-</td>
							</tr>
							<tr>
								<th scope="row" class="cartTotal">合計</th>
								<td class="tdTotal">&yen;<?php echo number_format($price*$selectQuantity+$shipping_fee); ?>-</td>
							</tr>
						</table><!-- /.cartTableST -->
						<div class="cartInbuttonArea">
              <a href="#" onclick="javascript:window.history.back(-1);return false;" class="arrowBackC linkBrown"><i class="fas fa-caret-left"></i>前のページに戻る</a>
              <form action="purchase.php" method="POST">
                <div class="tapButton procedure">
                  <input type="submit" name="purchase" value="購入手続きへ" id="cartInButton">
                </div>
              </form> 
              <span class="attention"><?php echo h($error_login); ?></span>
						</div><!-- /.cartInbuttonArea -->
          </div><!-- /.cartIn -->
        </div><!-- /.gifts -->
      </main><!-- /main -->
<?php include('footer_purchase.php'); ?>
<?php unset($_SESSION['error']); ?>
