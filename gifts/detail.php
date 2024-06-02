<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$selectQuantity = isset($_SESSION['selectQuantity']) ? $_SESSION['selectQuantity'] : NULL;

$sql = "SELECT * FROM gifts ORDER BY id DESC";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
	$record[] = $row;
}

foreach ($record as $row) {
  $id = h($row['id']);
  $c_name = h($row["c_name"]);
  $g_name = h($row['g_name']);
  $price = h($row['price']);
  $image1 = h($row['image1']);
  $image2 = h($row['image2']);
  $image3 = h($row['image3']);
  $quantity = h($row['quantity']);
  $description = h($row['description']);
  $type = h($row['type']);
  $size = h($row['size']);
  $material = h($row['material']);
  $pay_method = h($row['pay_method']);
  $delivery = h($row['delivery']);
  $shipping_fee = h($row['shipping_fee']);
  $url = h($row['url']);
}

$sql2 = "SELECT u.u_name, u.profile, u.role, u.id, g.u_id FROM users u INNER JOIN gifts g ON u.id=g.u_id ORDER BY id DESC";
$stmt2 = $db->query ( $sql2 );

while($row2 = $stmt2 -> fetch()) {
	$record2[] = $row2;
}

foreach ($record2 as $row2) {
  $u_name = h($row2['u_name']);
  $profile = h($row2['profile']);
  $role = h($row2['role']);
}

$db = null;

$_SESSION["g_name"] = $g_name;
$_SESSION["image1"] = $image1;
$_SESSION["price"] = $price;
$_SESSION["quantity"] = $quantity;
$_SESSION["shipping_fee"] = $shipping_fee;
?>

<?php include('header_Gdetail.php'); ?>
      <main>
        <div class="gifts">
          <h2 class="sectionTitle">Gifts</h2>
          <div class="sliderArea">
						<p id="slideImg">
              <img src="../mypage/original_gphoto/<?php echo $image1; ?>" alt="giftの写真1">
              <img src="../mypage/original_gphoto/<?php echo $image2; ?>" alt="giftの写真2">
              <img src="../mypage/original_gphoto/<?php echo $image3; ?>" alt="giftの写真3">
            </p>
						<div class="pnArea">
							<button id="prev" class="arrow">前に戻る</button>
							<button id="next" class="arrow">次へ</button>
						</div>
					</div><!-- /.sliderArea -->
					<div class="giftsDetailArea">
            <div class="userDetail">
              <span class="categoryTitle03"><?php echo $role; ?></span>
              <dl class="userDesc">
                <dt class="userName"><a href="#" class="linkBrown"><?php echo $u_name; ?></a></dt>
                <dd class="profile"><?php echo $profile; ?></dd>
              </dl>
              <a href="#" target="_blank" rel="noopener noreferrer" class="linkBrown url"><?php echo $url; ?><i class="fas fa-external-link-alt"></i></a>
            </div><!-- /.userDetail -->
            <div class="giftsDetail">
              <span class="categoryTitle02"><?php echo $c_name; ?></span>
              <h3 class="giftTitle titleDetail"><?php echo $g_name; ?></h3>
              <p class="detailDesc"><?php echo $description; ?></p>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">タイプ</dt>
								<dd><?php echo $type; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">サイズ</dt>
								<dd><?php echo $size; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">素 材</dt>
								<dd><?php echo $material; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">I D</dt>
								<dd><?php echo $id; ?></dd>
							</dl>
            </div><!-- /.giftsDetail -->
            <div class="purchaseDetail">
              <span class="categoryTitle03">Price</span>
              <p class="price">&yen;<?php echo number_format($price); ?>-<span class="small">(税込)</span></p>
              <dl class="giftsDesc purchase">
                <dt class="modalLabel detailPage">支 払</dt>
                <dd>現金（<?php echo $pay_method; ?>）</dd>
                <dt class="modalLabel detailPage">発 送</dt>
                <dd><?php echo $delivery; ?></dd>
                <dt class="modalLabel detailPage">送 料</dt>
                <dd>&yen;<?php echo number_format($shipping_fee); ?>-</dd>
              </dl>
              <aside><p>※北海道・沖縄・離島への発送は追加送料がかかります。</p></aside>
              <form action="cartIn.php" method="POST">
                <label for="quantity"><span class="quantityLabel">数 量</span></label>
                <select id="quantity" name="selectQuantity" required>
                  <option value="" hidden>選 択</option> 
                  <?php
                    for($i=1; $i<$quantity+1; $i++) {
                      echo "<option value='$i'";
                        if ($selectQuantity == $i) {
                          echo " selected>".$i."</option>";
                        } else {
                            echo ">".$i."</option>";
                        }
                    }
                  ?>
                </select>
                <div class="tapButton cart">
                  <input type="hidden" name="giftsID" value="<?php echo $id; ?>">
                  <input type="submit" name="cartIn" value="カートに入れる" id="cartInButton">
                </div>
              </form> 
            </div><!-- /.purchaseDetail -->
          </div><!-- /.giftsDetailArea -->
          <a href="#" onclick="javascript:window.history.back(-1);return false;" class="arrowBack linkBrown"><i class="fas fa-caret-left"></i>Gifts一覧ページに戻る</a>
        </div><!-- /.gifts -->
      </main><!-- /main -->
<?php include('footer_Gdetail.php'); ?>