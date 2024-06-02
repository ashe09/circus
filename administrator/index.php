<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$sql = "SELECT * FROM gifts ";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
	$record[] = $row;
}

$db = null;
?>

<?php include('header_administrator.php'); ?>
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
        <button class="adminmenuSelect aselect"><i class="fas fa-th-list"></i>管理メニュー</button>
        <nav class="adminMenu cmenu">
          <button class="categoryClose"><img src="../images/whiteClose.png" alt="close_button"></button>
          <ul>
            <li><a href="index.php"><i class="fas fa-gift"></i>Gifts一覧</a></li>
            <li><a href="projectsRecord.php"><i class="fas fa-user-friends"></i>Projects一覧</a></li>
            <li><a href="eventAppRecord.php"><i class="fas fa-address-book"></i>イベント申し込み</a></li>
            <li><a href="contactRecord.php"><i class="fas fa-envelope"></i>お問い合わせ</a></li>
            <li><a href="categoryEdit.php"><i class="fas fa-list-ul"></i>カテゴリー管理</a></li>
          </ul>
        </nav>
      </div><!-- /.categoryArea -->
      <main class="adminPage">
        <div class="administrator">
					<h2 class="sectionTitle">Administrator</h2>
        	<div class="subheadBar adminG">
            <h3>Gifts List</h3>
          </div>
          <form action="categoryGSearchResult.php" method="post" class="categorySearchFrom">
						<div class="formItem searchSelect">
						<label for="categorySearch">Giftsカテゴリー検索</label><br>
						<select id="categorySearch" name="categorySearch">
              <option value="" hidden>選択してください</option>
              <?php
                $gc_names = ["graphic" => "Graphic","product" => "Product","web" => "Web","fashion" => "Fashion","music" => "Music","paint" => "Paint","sculpture" => "Sculpture","movie" => "Movie","photo" => "Photo","cg" => "CG"];
                foreach ($gc_names as $key => $val) {
                  echo "<option value='$val'";
                    if ($gc_names == $val) {
                  echo " selected>".$val."</option>";
                  } else {
                    echo ">".$val."</option>";
                  }
                }
              ?>
						</select>
						</div><!-- /.formItem -->
						<div class="submitItem searchSubmit">
							<input type="submit" name="confirm" value="検 索" id="submitButton" class="searchButton">
						</div><!-- /.submitItem -->
					</form>
          <table class="adRecord">
          	<tr>
          		<th>ID</th>
          		<th>登録日時</th>
          		<th>編集</th>
          		<th>削除</th>
          		<th>カテゴリー</th>
          		<th class="th200">Giftsタイトル</th>
          		<th>販売価格</th>
          		<th class="th80">画像1</th>
          		<th class="th80">画像2</th>
          		<th class="th80">画像3</th>
          		<th class="th450">Giftsの詳細</th>
          		<th class="th120">タイプ</th>
          		<th class="th200">サイズ</th>
          		<th class="th200">素材</th>
          		<th>代金受け取り</th>
          		<th>発送</th>
          		<th>送料</th>
              <th class="th200">サイトURL</th>
          		<th>出品者</th>
            </tr>
            <?php 		
            foreach ($record as $row) {
            ?>
          	<tr>
          		<td><?php echo h($row["id"]); ?></td>
          		<td><?php echo h($row["create_date"]); ?></td>
          		<td class="ed">編集</td>
          		<td class="ed">削除</td>
          		<td><?php echo h($row["c_name"]); ?></td>
          		<td class="gpName"><?php echo h($row["g_name"]); ?></td>
          		<td><?php echo number_format($row["price"]); ?></td>
          		<td class="admingiftsImg">
              <?php
              if ($row["image1"] !== "") {
                echo '<img src="../mypage/original_gphoto/'.$row["image1"].'" alt="Gifts画像1">';
              }
              ?>
              </td>
              <td class="admingiftsImg">
              <?php
              if ($row["image2"] !== "") {
                echo '<img src="../mypage/original_gphoto/'.$row["image2"].'" alt="Gifts画像2">';
              }
              ?>
              </td>
              <td class="admingiftsImg">
              <?php
              if ($row["image3"] !== "") {
                echo '<img src="../mypage/original_gphoto/'.$row["image3"].'" alt="Gifts画像3">';
              }
              ?>
              </td>
          		<td class="left"><?php echo nl2br($row["description"]); ?></td>
          		<td><?php echo h($row["type"]); ?></td>
          		<td><?php echo h($row["size"]); ?></td>
          		<td><?php echo h($row["material"]); ?></td>
          		<td><?php echo h($row["pay_method"]); ?></td>
          		<td><?php echo h($row["delivery"]); ?></td>
          		<td><?php echo number_format($row["shipping_fee"]); ?></td>
              <td><?php echo h($row["url"]); ?></td>
              <td><?php echo h($row["u_id"]); ?></td>
            </tr>
            <?php
            }
            ?>
          </table>
          <div class="paginationWrapper">
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
        </div><!-- /.administrator -->
      </main><!-- /main -->
<?php include('footer_administrator.php'); ?>