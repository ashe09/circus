<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require_once ("dbConnect.php");
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");
?>

<?php include('header_administrator.php'); ?>
  <body id="top">
    <div class="wrapper adminCATEWrapper">
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
            <h3>カテゴリー管理</h3>
          </div>
          <div class="adminCategoryMenu">
						<button class="cTap addCategory orange">追 加</button>
						<button class="cTap deleteCategory">削 除</button>
          </div><!-- /.adminCategoryMenu -->
          <form action="categoryAddcomplete.php" method="post" id="categoryAddArea" class="categoryFrom">
						<div class="formItem">
						<label>カテゴリー追加<br>
						<input type="text" name="c_nameAdd"></label>
						</div><!-- /.formItem -->
						<div class="submitItem">
							<input type="submit" name="confirm" value="追 加" id="submitButton">
						</div><!-- /.submitItem -->
					</form>

				<form action="categoryGDelete.php" method="post" id="categoryGDelete" class="categorySearchFrom ">
					<div class="formItem searchSelect top48">
						<label for="categoryGSearch">Giftsカテゴリー検索</label><br>
						<select id="categoryGSearch" name="categoryGSearch">
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
							<input type="submit" name="confirm" value="削 除" id="submitGDeleteButton" class="searchButton">
					</div><!-- /.submitItem -->
				</form>
       
				<form action="categoryPDelete.php" method="post" id="categoryPDelete" class="categorySearchFrom">
					<div class="formItem searchSelect top48">
						<label for="categoryPSearch">Projectsカテゴリー検索</label><br>
						<select id="categoryPSearch" name="categoryPSearch">
							<option value="" hidden>選択してください</option>
							<?php
                $pc_names = ["graphic" => "Graphic","product" => "Product","web" => "Web","fashion" => "Fashion","music" => "Music","paint" => "Paint","sculpture" => "Sculpture","movie" => "Movie","photo" => "Photo","cg" => "CG"];
                foreach ($pc_names as $key => $val) {
                  echo "<option value='$val'";
                    if ($pc_names == $val) {
                  echo " selected>".$val."</option>";
                  } else {
                    echo ">".$val."</option>";
                  }
                }
              ?>
						</select>
					</div><!-- /.formItem -->
					<div class="submitItem searchSubmit">
							<input type="submit" name="confirm" value="削 除" id="submitPDeleteButton" class="searchButton">
					</div><!-- /.submitItem -->
				</form>
        </div><!-- /.administrator -->
      </main><!-- /main -->
<?php include('footer_administrator.php'); ?>