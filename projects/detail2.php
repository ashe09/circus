<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;
$error_login = isset($error['login']) ? $error['login'] : NULL;

$sql = "SELECT * FROM projects WHERE id = 4";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
	$record[] = $row;
}

foreach ($record as $row) {
  $id = h($row['id']);
  $c_name = h($row["c_name"]);
  $p_name = h($row['p_name']);
  $pay = h($row['pay']);
  $image1 = h($row['image1']);
  $image2 = h($row['image2']);
  $image3 = h($row['image3']);
  $description = h($row['description']);
  $type = h($row['type']);
  $target = h($row['target']);
  $workRange = h($row['workRange']);
  $pay_method = h($row['pay_method']);
  $startY = h($row['startY']);
  $startM = h($row['startM']);
  $startD = h($row['startD']);
  $deadlineY = h($row['deadlineY']);
  $deadlineM = h($row['deadlineM']);
  $deadlineD = h($row['deadlineD']);
  $schedule = h($row['schedule']);
  $url = h($row['url']);
}

$sql2 = "SELECT u.u_name, u.profile, u.role, u.id, p.u_id FROM users u INNER JOIN projects p ON u.id=p.u_id WHERE u.id=3";
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
?>

<?php include('header_Pdetail.php'); ?>
      <main>
        <div class="gifts">
					<span class="attention"><?php echo h($error_login); ?></span>
          <h2 class="sectionTitle">Projects</h2>
          <div class="sliderArea">
						<p id="slideImg">
              <img src="../mypage/original_pphoto/<?php echo $image1; ?>" alt="projectの写真1">
              <img src="../mypage/original_pphoto/<?php echo $image2; ?>" alt="projectの写真2">
              <img src="../mypage/original_pphoto/<?php echo $image3; ?>" alt="projectの写真3">
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
              <h3 class="giftTitle titleDetail"><?php echo $p_name; ?></h3>
              <p class="detailDesc"><?php echo $description; ?></p>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">タイプ</dt>
								<dd><?php echo $type; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">ターゲット</dt>
								<dd><?php echo $target; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">作業範囲</dt>
								<dd><?php echo $workRange; ?></dd>
							</dl>
							<dl class="giftsDesc marginB0">
								<dt class="modalLabel detailPage">I D</dt>
								<dd><?php echo $id; ?></dd>
							</dl>
            </div><!-- /.giftsDetail -->
            <div class="purchaseDetail">
              <span class="categoryTitle03">Pay</span>
              <p class="price">&yen;<?php echo number_format($pay); ?>-<span class="small">(税込)</span></p>
              <dl class="giftsDesc purchase">
                <dt class="modalLabel detailPage">支 払</dt>
                <dd><?php echo $pay_method; ?></dd>
                <dt class="modalLabel detailPage">開 始</dt>
                <dd><?php echo $startY; ?>年<?php echo $startM; ?>月<?php echo $startD; ?>日</dd>
                <dt class="modalLabel detailPage">締 切</dt>
                <dd><?php echo $deadlineY; ?>年<?php echo $deadlineM; ?>月<?php echo $deadlineD; ?>日</dd>
                <dt class="modalLabel detailPage">日 程</dt>
                <dd><?php echo $schedule; ?></dd>
              </dl>
              <aside><p>※締切と日程は変更する場合があります。</p></aside>
              <form action="entry.php" method="POST" class="tapButton cart">
                <input type="hidden" name="projectsID" value="<?php echo $id; ?>">
								<input type="submit" name="entry" value="エントリーする" id="cartInButton">
              </form> 
            </div><!-- /.purchaseDetail -->
          </div><!-- /.giftsDetailArea -->
          <a href="#" onclick="javascript:window.history.back(-1);return false;" class="arrowBack linkBrown"><i class="fas fa-caret-left"></i>Projects一覧ページに戻る</a>
        </div><!-- /.gifts -->
      </main><!-- /main -->

<?php include('footer_Pdetail.php'); ?>
<?php unset($_SESSION['error']); ?>