<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$sql = "SELECT * FROM event_app ";
$stmt = $db->query ( $sql );

while($row = $stmt -> fetch()) {
	$record[] = $row;
}

$db = null;
?>

<?php include('header_administrator.php'); ?>
  <body id="top">
    <div class="wrapper adminEWrapper">
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
        	<div class="subheadBar">
            <h3>イベント申し込み</h3>
          </div>
          <table class="adRecord">
          	<tr>
          		<th>ID</th>
          		<th>登録日時</th>
          		<th>編集</th>
          		<th>削除</th>
          		<th class="th200">イベント名</th>
          		<th class="th200">日程</th>
          		<th>時間</th>
          		<th class="th120">名前</th>
          		<th class="th200">メール</th>
          		<th>電話</th>
          		<th>メディア</th>
          		<th class="th300">備考</th>
            </tr>
            <?php 		
            foreach ($record as $row) {
            ?>
          	<tr>
          		<td><?php echo h($row["id"]); ?></td>
          		<td><?php echo h($row["create_date"]); ?></td>
          		<td class="ed">編集</td>
          		<td class="ed">削除</td>
          		<td class="gpName"><?php echo h($row["eventTitle"]); ?></td>
          		<td><?php echo h($row["date"]); ?></td>
          		<td><?php echo h($row["time"]); ?></td>
          		<td><?php echo h($row["name"]); ?></td>
          		<td><?php echo h($row["email"]); ?></td>
          		<td><?php echo h($row["tel"]); ?></td>
          		<td><?php echo h($row["medium"]); ?></td>
          		<td class="left"><?php echo nl2br($row["comment"]); ?></td>
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