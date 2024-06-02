<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
header("X-FRAME-OPTIONS: SAMEORIGIN");
require 'functions.php';
require_once ("dbConnect.php");
$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

if (isset($_POST["email"]) && isset($_POST["password"])) {

	$_POST = checkInput( $_POST );
	$email = h($_POST['email']);
	$pass_raw = h($_POST['password']);
	$pass = md5($pass_raw);

	$sql = "SELECT * FROM users WHERE email='$email' and password='$pass'";
	$stmt = $db->query ( $sql );
	if ($stmt -> rowCount() == 1) {
		while ($row = $stmt->fetch()) {
		$password_db = $row['password'];
	}

		$sql = "SELECT * FROM users WHERE email='$email'";
		$stmt = $db->query ( $sql );
		while($row = $stmt -> fetch()) {
		$record[] = $row;
		}

		foreach ($record as $row) {
			$id = h($row['id']);
			$name = h($row['name']);
			$ruby = h($row['ruby']);
			$u_name = h($row['u_name']);
			$email = h($row['email']);
			$role = h($row['role']);
			$postcode = h($row['postcode']);
			$address = h($row['address']);
			$tel = h($row['tel']);
			$fn = h($row['photo']);
			$profile = h($row['profile']);
			$url = h($row['url']);
			$type = h($row['type']);
		}

		$_SESSION['user'] = $id;

		$backpage = $_SERVER['HTTP_REFERER'];
		if (isset($backpage)) {
			$_SESSION['user'] = $id;
			header("Location:$backpage");
			exit();
		}
	} else {
	$_SESSION = array();
	session_destroy();
	header("Location:../index.php");
	exit();
	}
}

if (isset($_SESSION["user"])) {
	$id = $_SESSION["user"];
	$sql = "SELECT * FROM users WHERE id='$id'";
	$stmt = $db->query ( $sql );
	while($row = $stmt -> fetch()) {
	$record[] = $row;
	}

	foreach ($record as $row) {
		$id = h($row['id']);
		$name = h($row['name']);
		$ruby = h($row['ruby']);
		$u_name = h($row['u_name']);
		$email = h($row['email']);
		$role = h($row['role']);
		$postcode = h($row['postcode']);
		$address = h($row['address']);
		$tel = h($row['tel']);
		$fn = h($row['photo']);
		$profile = h($row['profile']);
		$url = h($row['url']);
		$type = h($row['type']);
	}
	
	$_SESSION['user'] = $id;
	
	$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;
	$error_photo = isset($error['photo']) ? $error['photo'] : NULL;

	$gc_name = isset($_SESSION['gc_name']) ? $_SESSION['gc_name'] : NULL;
	$g_name = isset($_SESSION['g_name']) ? $_SESSION['g_name'] : NULL;
	$price = isset($_SESSION['price']) ? $_SESSION['price'] : NULL;
	$g_desc = isset($_SESSION['g_desc']) ? $_SESSION['g_desc'] : NULL;
	$g_quantity = isset($_SESSION['g_quantity']) ? $_SESSION['g_quantity'] : NULL;
	$g_type = isset($_SESSION['g_type']) ? $_SESSION['g_type'] : NULL;
	$size = isset($_SESSION['size']) ? $_SESSION['size'] : NULL;
	$material = isset($_SESSION['material']) ? $_SESSION['material'] : NULL;
	$pay_method = isset($_SESSION['pay_method']) ? $_SESSION['pay_method'] : NULL;
	$delivery = isset($_SESSION['delivery']) ? $_SESSION['delivery'] : NULL;
	$shipping_fee = isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee'] : NULL;
	$g_url = isset($_SESSION['g_url']) ? $_SESSION['g_url'] : NULL;

	$error_giftsImg = isset($error['giftsImg']) ? $error['giftsImg'] : NULL;
	$error_pay_method = isset($error['pay_method']) ? $error['pay_method'] : NULL;
	$error_g_url = isset($error['g_url']) ? $error['g_url'] : NULL;

	$pc_name = isset($_SESSION['pc_name']) ? $_SESSION['pc_name'] : NULL;
	$p_name = isset($_SESSION['p_name']) ? $_SESSION['p_name'] : NULL;
	$pay = isset($_SESSION['pay']) ? $_SESSION['pay'] : NULL;
	$p_desc = isset($_SESSION['p_desc']) ? $_SESSION['p_desc'] : NULL;
	$p_type = isset($_SESSION['p_type']) ? $_SESSION['p_type'] : NULL;
	$target = isset($_SESSION['target']) ? $_SESSION['target'] : NULL;
	$workRange = isset($_SESSION['workRange']) ? $_SESSION['workRange'] : NULL;
	$pPay_method = isset($_SESSION['pPay_method']) ? $_SESSION['pPay_method'] : NULL;
	$es_year = isset($_SESSION['es_year']) ? $_SESSION['es_year'] : NULL;
	$es_month = isset($_SESSION['es_month']) ? $_SESSION['es_month'] : NULL;
	$es_day = isset($_SESSION['es_day']) ? $_SESSION['es_day'] : NULL;
	$ed_year = isset($_SESSION['ed_year']) ? $_SESSION['ed_year'] : NULL;
	$ed_month = isset($_SESSION['ed_month']) ? $_SESSION['ed_month'] : NULL;
	$ed_day = isset($_SESSION['ed_day']) ? $_SESSION['ed_day'] : NULL;
	$schedule = isset($_SESSION['schedule']) ? $_SESSION['schedule'] : NULL;
	$p_url = isset($_SESSION['p_url']) ? $_SESSION['p_url'] : NULL;

	$error_projectsImg = isset($error['projectsImg']) ? $error['projectsImg'] : NULL;
	$error_pPay_method = isset($error['pPay_method']) ? $error['pPay_method'] : NULL;
	$error_p_url = isset($error['p_url']) ? $error['p_url'] : NULL;

} else {
	$_SESSION = array();
	session_destroy();
}

$db = null;

?>

<?php include('header_mypage.php'); ?>
      <main>
        <div class="mypage">
        	<button class="mypageSelect cselect"><i class="fas fa-gift"></i>マイページメニュー</button>
					<h2 class="sectionTitle sectionTitle560">My page</h2>
          <div class="mypageMenu">
						<button class="modify orange">Profile変更</button>
						<button class="registerG beige">Gifts登録</button>
						<button class="registerP beige">Projects登録</button>
          </div><!-- /.mypageMenu -->

          <div class="mypageMenu560">
						<button class="categoryClose"><img src="../images/whiteClose.png" alt="close_button"></button>
						<button class="modify560">Profile変更</button>
						<button class="registerG560">Gifts登録</button>
						<button class="registerP560">Projects登録</button>
          </div><!-- /.mypageMenu -->

        	<div class="modifyArea">
						<div class="formArea">
							<form action="modifyComplete.php" method="post" enctype='multipart/form-data'>
								<div class="formItem photoArea">
									<?php
										if ($fn !== "") {
											echo '<img src="../signup/thumb_uphoto/'.$fn.'" alt="プロフィール写真" class="mypagePhoto">';
										} else {
											echo '<img src="../signup/thumb_uphoto/mypagePhoto.svg" alt="プロフィール写真" class="mypagePhoto">';
										}
									?>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>お名前<span class="required">必須</span><br>
									<input type="text" name="name" autocomplete="name" required value="<?php echo $name; ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>ふりがな　＊全角入力<span class="required">必須</span><br>
									<input type="text" name="ruby" autocomplete="name" required value="<?php echo $ruby; ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>ユーザー名<span class="required">必須</span><br>
									<input type="text" name="u_name" required value="<?php echo $u_name; ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>メールアドレス<span class="required">変更不可</span><br>
									<input type="email" name="email" autocomplete="email" value="<?php echo $email; ?>" readonly></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>パスワード　＊半角英数字を含む5～30文字以内<span class="required">必須</span><br>
									<input type="password" name="password" placeholder="パスワード" required></label>
								</div><!-- /.formItem -->
								<div class="formItem radio">
									どちらで登録しますか？<br>
									<input type="radio" name="role" value="Artists" id="artists" <?php if($role == "Artists") {echo "checked";} ?>><label for="artists" class="artists myPageTop">Artists</label>
									<input type="radio" name="role" value="Partners" id="partners" <?php if($role == "Partners") {echo "checked";} ?>><label for="partners" class="partners myPageTop">Partners</label>
								</div><!-- /.formItem -->
								<div class="formItem postCodeWrap marginTop">
									<label class="postCode">郵便番号<span class="required">必須</span><br>
									<input type="text" name="postcode" autocomplete="postal-code" placeholder="1234567" onKeyUp="AjaxZip3.zip2addr('postcode', '', 'add', 'add');" required value="<?php echo $postcode; ?>"></label>
								</div>
								<div class="formItem">
									<label>住所<span class="required">必須</span><br>
									<input type="text" name="add" placeholder="ご住所" required value="<?php echo $address; ?>"></label>
								</div>
								<div class="formItem">
									<label>電話番号 ＊半角入力<br>
									<input type="tel" name="tel" autocomplete="tel" placeholder="09012345678" value="<?php echo $tel; ?>"></label>
								</div><!-- /.formItem -->
								 <div class="formItem photo">
									プロフィール写真<br>＊1MB以内(形式：jpg、png、gif)<span class="attention"><?php echo h($error_photo); ?></span><br>
									<div class="formFlex flexWrap">
									<label><input type="file" name="update_photo" enctype="multipart/form-data" class="photoUpload">ファイルを選択</label>
									<p class="photoName">選択されていません。</p>
									<button type="button" class="photoClear">選択ファイルをクリア</button>
									</div>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>プロフィール　＊600字以内<br>
									<textarea name="profile" placeholder="プロフィール"><?php echo $profile; ?></textarea></label>
								</div><!-- /.formItem -->
								<div class="formItem">
                <label>サイトURL<br>
                <input type="url" name="url" placeholder="https://www.circus.co.jp" value="<?php echo $url; ?>"></label>
              </div><!-- /.formItem -->
								<div class="submitItem">
									<input type="submit" name="submit" value="変更する" id="submitButton">
								</div><!-- /.submitItem -->
								<a href="accountDelete.php" class="accountD linkBrown">退会を希望する方はこちら</a>
								<?php
									if ($type == 1) {
										echo '<a href="../administrator/index.php" class="accountA">管理ページ</a>';
									}
								?>
							</form><!-- /form -->
						</div><!-- /.formArea -->
					</div><!-- /.modifyArea -->

					<div class="registerGArea">
						<div class="formArea">
							<form action="registergComplete.php" method="post" enctype='multipart/form-data' multiple="multiple">
								<p class="formAttention">必須項目のご入力をお願いいたします。</p>
								<div class="formItem c_nameSelect">
									<label for="gc_name">カテゴリー</label><span class="required">必須</span><br>
									<select id="gc_name" name="gc_name" required>
										<option value="" hidden>選択してください</option>
										<?php
                    $gc_names = ["graphic" => "Graphic","product" => "Product","web" => "Web","fashion" => "Fashion","music" => "Music","paint" => "Paint","sculpture" => "Sculpture","movie" => "Movie","photo" => "Photo","cg" => "CG"];
                    foreach ($gc_names as $key => $val) {
                      echo "<option value='$val'";
                        if ($gc_name == $val) {
                      echo " selected>".$val."</option>";
                      } else {
                        echo ">".$val."</option>";
                      }
                    }
                    ?>
									</select>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>Giftsタイトル<span class="required">必須</span><br>
									<input type="text" name="g_name" placeholder="Giftタイトル" required value="<?php echo h($gc_name); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label for="price">販売価格</label><span class="required">必須</span><br>
									<div class="formFlex">
										<input type="text" name="price" placeholder="1000" id="price" required value="<?php echo h($price); ?>"><span class="en">円</span>
									</div>
								</div><!-- /.formItem -->
								
								<div class="formItem photo">
									Gifts画像(3枚までアップロード可能です。)<span class="required">必須</span><span class="attention"><?php echo h($error_giftsImg); ?></span><br>＊1枚1MB以内(形式：jpg、png、gif)<br>
									<div class="formFlex flexWrap">
									<label><input type="file" name="giftsImg[]" enctype="multipart/form-data" multiple="multiple" accept=".png, .jpg, .jpeg, .png, .gif"  class="photoUpload">ファイルを選択</label>
									<p class="photoName hiddenName">選択されていません。</p>
									<button type="button" class="photoClear">選択ファイルをクリア</button>
									</div>
								</div><!-- /.formItem -->
								
								<div class="formItem">
									<label>Giftsの詳細<span class="required">必須</span><br>
									<textarea name="g_desc" placeholder="Giftsの詳細について詳しく入力してください。" required><?php echo h($g_desc); ?></textarea></label>
								</div><!-- /.formItem -->
								<div class="formItem c_nameSelect">
									<label for="g_quantity">数量</label><span class="required">必須</span><br>
                  <select id="g_quantity" name="g_quantity" required>
										<option value="" hidden>選択してください</option>
										<?php
										for($i=1; $i<51; $i++) {
											echo "<option value='$i'";
												if ($g_quantity == $i) {
													echo " selected>".$i."</option>";
												} else {
														echo ">".$i."</option>";
												}
										}
										?> 
                  </select>
								</div>
								<div class="formItem">
									<label>タイプ<span class="required">必須</span><br>
									<input type="text" name="g_type" placeholder="絵画" required value="<?php echo h($g_type); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>サイズ<br>
									<input type="text" name="size" placeholder="50cm×50cm" value="<?php echo h($size); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>素材<br>
									<input type="text" name="material" placeholder="キャンバス・油彩" value="<?php echo h($material); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem checkbox">
									代金受け取り方法<span class="required">必須</span><span class="attention"><?php echo h($error_pay_method); ?></span><br>＊複数回答可<br>
									<?php
										$pay_methods = ["advanceg" => "振り込み","codg" => "代引き"];
										foreach($pay_methods as $key => $val){
											echo "<input type='checkbox' id='$key' name='pay_method[]' value='$val'";
											if (isset($_SESSION ['pay_method'] ) && in_array($val, (array)$_SESSION ['pay_method'])) {
                        echo "checked><label for='$key'>".$val."</label>";
                      } else {
                        echo "><label for='$key'>".$val."</label>";
                      }
                    }
									?>
                </div><!-- /.formItem -->
                <div class="formItem radio mypageDel">
									発送方法<span class="required">必須</span><br>
									<input type="radio" name="delivery" value="ヤマト運輸" id="yamato" checked <?php if($delivery == "ヤマト運輸") {echo "checked";} ?>><label for="yamato" class="yamato">ヤマト運輸</label>
									<input type="radio" name="delivery" value="郵便局" id="japanPost"  <?php if($delivery == "郵便局") {echo "checked";} ?>><label for="japanPost" class="japanPost">郵便局</label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label for="shipping_fee">送料</label><span class="required">必須</span><br>
									<div class="formFlex">
										<input type="text" name="shipping_fee" placeholder="1000" id="shipping_fee" required value="<?php echo h($shipping_fee); ?>"><span class="en">円</span>
									</div>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>サイトURL<br>
									<input type="url" name="g_url" placeholder="https://www.circus.co.jp" value="<?php echo h($g_url); ?>"></label>
								</div><!-- /.formItem -->

								<div class="submitItem">
									<input type="submit" name="submit" value="登 録" id="submitGButton">
								</div><!-- /.submitItem -->
							</form><!-- /form -->
						</div><!-- /.formArea -->
					</div><!-- /.registerGArea -->

					<div class="registerPArea">
						<div class="formArea">
							<form action="registerpComplete.php" method="post" enctype="multipart/form-data">
								<p class="formAttention">必須項目のご入力をお願いいたします。</p>
								<div class="formItem c_nameSelect">
									<label for="pc_name">カテゴリー</label><span class="required">必須</span><br>
									<select id="pc_name" name="pc_name" required>
										<option value="" hidden>選択してください</option>
										<?php
										$pc_names = ["graphic" => "Graphic","product" => "Product","web" => "Web","fashion" => "Fashion","music" => "Music","paint" => "Paint","sculpture" => "Sculpture","movie" => "Movie","photo" => "Photo","cg" => "CG"];
										foreach ($pc_names as $key => $val) {
											echo "<option value='$val'";
												if ($pc_name == $val) {
											echo " selected>".$val."</option>";
											} else {
												echo ">".$val."</option>";
											}
										}
										?>
                </select>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>Projectsタイトル<span class="required">必須</span><br>
									<input type="text" name="p_name" placeholder="Giftタイトル" required value="<?php echo h($p_name); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label for="pay">支払い価格</label><span class="required">必須</span><br>
									<div class="formFlex">
										<input type="text" name="pay" placeholder="10000" id="pay" required value="<?php echo h($pay); ?>"><span class="en">円</span>
									</div>
								</div><!-- /.formItem -->
							
								<div class="formItem photo">
									Projects画像(3枚までアップロード可能です。)<span class="required">必須</span><span class="attention"><?php echo h($error_projectsImg); ?></span><br>＊1枚1MB以内(形式：jpg、png、gif)<br>
									<div class="formFlex flexWrap">
									<label><input type="file" name="projectsImg[]" enctype="multipart/form-data" multiple="multiple" accept=".png, .jpg, .jpeg, .png, .gif"  class="photoUpload">ファイルを選択</label>
									<p class="photoName hiddenName">選択されていません。</p>
									<button type="button" class="photoClear">選択ファイルをクリア</button>
									</div>
								</div><!-- /.formItem -->

								<div class="formItem">
									<label>Projectsの詳細<span class="required">必須</span><br>
									<textarea name="p_desc" placeholder="Giftsの詳細について詳しく入力してください。" required><?php echo h($p_desc); ?></textarea></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>タイプ<span class="required">必須</span><br>
									<input type="text" name="p_type" placeholder="システム構築" required value="<?php echo h($p_type); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>ターゲット<br>
									<input type="text" name="target" placeholder="20代〜30代" value="<?php echo h($target); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>作業範囲<br>
									<input type="text" name="workRange" placeholder="依頼開始〜納品完了まで" value="<?php echo h($workRange); ?>"></label>
								</div><!-- /.formItem -->
								<div class="formItem checkbox">
									支払い方法<span class="required">必須</span><span class="attention"><?php echo h($error_pPay_method); ?></span><br>＊複数回答可<br>
									<?php
										$pPay_methods = ["transfer" => "振り込み (Project完了後)","ontheDay" => "当日払い","none" => "無し"];
										foreach($pPay_methods as $key => $val){
											echo "<input type='checkbox' id='$key' name='pPay_method[]' value='$val'";
											if (isset($_SESSION ['pPay_method'] ) && in_array($val, (array)$_SESSION ['pPay_method'])) {
                        echo "checked><label for='$key'>".$val."</label>";
                      } else {
                        echo "><label for='$key'>".$val."</label>";
                      }
                    }
									?>
                </div><!-- /.formItem -->
                <div class="formItem select">
                <div class="year">
                  <label for="year">エントリー開始 ＊西暦</label><br>
                  <div class="formFlex">
                    <input type="text" name="es_year" placeholder="例）2000" id="es_year" required value="<?php echo h($es_year); ?>"><span class="nen">年</span>
                  </div>
                </div>
                <div class="mselect formFlex"><i class="fas fa-caret-down"></i>
                  <select id="es_month" name="es_month" required>
										<option value="" hidden>選択してください</option>
										<?php
										for($i=1; $i<13; $i++) {
											echo "<option value='$i'";
												if ($es_month == $i) {
													echo " selected>".$i."</option>";
												} else {
														echo ">".$i."</option>";
												}
										}
										?> 
                  </select><span class="p_tsukihi">月</span>
                </div>
                <div class="dselect formFlex"><i class="fas fa-caret-down"></i>
                  <select id="es_day" name="es_day" required>
										<option value="" hidden>選択してください</option>
										<?php
										for($i=1; $i<32; $i++) {
											echo "<option value='$i'";
												if ($es_day == $i) {
													echo " selected>".$i."</option>";
												} else {
														echo ">".$i."</option>";
												}
										}
										?> 
                  </select><span class="p_tsukihi">日</span>
                </div>
              </div><!-- /.formItem select -->
              <div class="formItem select">
                <div class="year">
                  <label for="year">エントリー締切 ＊西暦</label><br>
                  <div class="formFlex">
                    <input type="text" name="ed_year" placeholder="例）2000" id="ed_year" required value="<?php echo h($ed_year); ?>"><span class="nen">年</span>
                  </div>
                </div>
                <div class="mselect formFlex"><i class="fas fa-caret-down"></i>
                  <select id="ed_month" name="ed_month" required>
										<option value="" hidden>選択してください</option>
										<?php
										for($i=1; $i<13; $i++) {
											echo "<option value='$i'";
												if ($ed_month == $i) {
													echo " selected>".$i."</option>";
												} else {
														echo ">".$i."</option>";
												}
										}
										?> 
                  </select><span class="p_tsukihi">月</span>
                </div>
                <div class="dselect formFlex"><i class="fas fa-caret-down"></i>
                  <select id="ed_day" name="ed_day" required>
                    <option value="" hidden>選択してください</option>
										<?php
										for($i=1; $i<32; $i++) {
											echo "<option value='$i'";
												if ($ed_day == $i) {
													echo " selected>".$i."</option>";
												} else {
														echo ">".$i."</option>";
												}
										}
										?> 
                  </select><span class="p_tsukihi">日</span>
                </div>
              </div><!-- /.formItem select -->
								<div class="formItem">
									<label>スケジュール<span class="required">必須</span><br>
									<textarea name="schedule" placeholder="スケジュールの詳細。" required><?php echo h($schedule); ?></textarea></label>
								</div><!-- /.formItem -->
								<div class="formItem">
									<label>サイトUR<span class="attention"><?php echo h($error_p_url); ?></span>L<br>
									<input type="url" name="p_url" placeholder="https://www.circus.co.jp" value="<?php echo h($p_url); ?>"></label>
								</div><!-- /.formItem -->
								<div class="submitItem">
									<input type="submit" name="submit" value="登 録" id="submitPButton">
								</div><!-- /.submitItem -->
							</form><!-- /form -->
						</div><!-- /.formArea -->
					</div><!-- /.registerPArea -->
        </div><!-- /.mypage -->
      </main><!-- /main -->
<?php include('footer_mypage.php'); ?>

<?php
	unset($_SESSION['gc_name']);
	unset($_SESSION['g_name']);
	unset($_SESSION['price']);
	unset($_SESSION['g_desc']);
	unset($_SESSION['g_quantity']);
	unset($_SESSION['g_type']);
	unset($_SESSION['size']);
	unset($_SESSION['material']);
	unset($_SESSION['pay_method']);
	unset($_SESSION['delivery']);
	unset($_SESSION['shipping_fee']);
	unset($_SESSION['g_url']);
	unset($_SESSION['error']);

	unset($_SESSION['pc_name']);
	unset($_SESSION['p_name']);
	unset($_SESSION['pay']);
	unset($_SESSION['p_desc']);
	unset($_SESSION['p_type']);
	unset($_SESSION['target']);
	unset($_SESSION['workRange']);
	unset($_SESSION['pPay_method']);
	unset($_SESSION['es_year']);
	unset($_SESSION['es_month']);
	unset($_SESSION['es_day']);
	unset($_SESSION['ed_year']);
	unset($_SESSION['ed_month']);
	unset($_SESSION['ed_day']);
	unset($_SESSION['schedule']);
	unset($_SESSION['p_url']);
?>