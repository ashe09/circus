<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
$backpage = $_SERVER['HTTP_REFERER'];
if(isset($user)) {
	header("Location:$backpage");
  exit();
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$ruby = isset($_SESSION['ruby']) ? $_SESSION['ruby'] : NULL;
$u_name = isset($_SESSION['u_name']) ? $_SESSION['u_name'] : NULL;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
$pass = isset($_SESSION['password']) ? $_SESSION['password'] : NULL;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : NULL;
$postcode = isset($_SESSION['postcode']) ? $_SESSION['postcode'] : NULL;
$add = isset($_SESSION['add']) ? $_SESSION['add'] : NULL;
$tel = isset($_SESSION['tel']) ? $_SESSION['tel'] : NULL;
$file_name = isset($_SESSION['photo']) ? $_SESSION['photo'] : NULL;
$profile = isset($_SESSION['profile']) ? $_SESSION['profile'] : NULL;
$url = isset($_SESSION['url']) ? $_SESSION['url'] : NULL;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;

$error_name = isset($error['name']) ? $error['name'] : NULL;
$error_ruby = isset($error['ruby']) ? $error['ruby'] : NULL;
$error_u_name = isset($error['u_name']) ? $error['u_name'] : NULL;
$error_email = isset($error['email']) ? $error['email'] : NULL;
$error_password = isset($error['password']) ? $error['password'] : NULL;
$error_role = isset($error['role']) ? $error['role'] : NULL;
$error_postcode = isset($error['postcode']) ? $error['postcode'] : NULL;
$error_add = isset($error['add']) ? $error['add'] : NULL;
$error_tel = isset($error['tel']) ? $error['tel'] : NULL;
$error_photo = isset($error['photo']) ? $error['photo'] : NULL;
$error_profile = isset($error['profile']) ? $error['profile'] : NULL;
$error_url = isset($error['url']) ? $error['url'] : NULL;

$_SESSION = array();
session_destroy();
?>

<?php include('header_signup.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Sign up</h2>
          <h3 class="signupSubhead">新規会員登録(無料)</h3>
          <p>必須項目のご入力を<span class="newLine">お願いいたします。</span></p>
          <div class="formArea">
            <form action="confirm.php" enctype='multipart/form-data' method="post">
              <div class="formItem">
                <label>お名前<span class="required">必須</span><span class="attention"><?php echo h($error_name); ?></span><br>
                <input type="text" name="name" autocomplete="name" placeholder="山田　太郎" value="<?php echo h($name); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>ふりがな　＊全角入力<span class="required">必須</span><span class="attention"><?php echo h($error_ruby); ?></span><br>
                <input type="text" name="ruby" autocomplete="name" placeholder="やまだ　たろう" value="<?php echo h($ruby); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>ユーザー名<span class="required">必須</span><span class="attention"><?php echo h($error_u_name); ?></span><br>
                <input type="text" name="u_name" placeholder="ユーザー名" value="<?php echo h($u_name); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>メールアドレス<span class="required">必須</span><span class="attention"><?php echo h($error_email); ?></span><br>
                <input type="email" name="email" autocomplete="email" placeholder="yamada@gmail.com" value="<?php echo h($email); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>パスワード　＊半角英数字を含む5～30文字以内<span class="required">必須</span><span class="attention"><?php echo h($error_password); ?></span><br>
                <input type="password" name="password" placeholder="パスワード"></label>
              </div><!-- /.formItem -->
              <div class="formItem radio">
                どちらで登録しますか？<span class="required newLine requiredLabel">必須</span><span class="attention"><?php echo h($error_role); ?></span><br>
                <input type="radio" name="role" value="Artists" id="artists" <?php if($role == "Artists") {echo "checked";} ?>><label for="artists" class="artists">Artists</label>
                <input type="radio" name="role" value="Partners" id="partners" <?php if($role == "Partners") {echo "checked";} ?>><label for="partners" class="partners">Partners</label>
              </div><!-- /.formItem -->
              <div class="formItem postCodeWrap">
                <label class="postCode">郵便番号<span class="required">必須</span><span class="attention"><?php echo h($error_postcode); ?></span><br>
                <input type="text" name="postcode" autocomplete="postal-code" placeholder="1234567" onKeyUp="AjaxZip3.zip2addr('postcode', '', 'add', 'add');" value="<?php echo h($postcode); ?>"></label>
              </div>
              <div class="formItem">
                <label>住所<span class="required">必須</span><span class="attention"><?php echo h($error_add); ?></span><br>
                <input type="text" name="add" placeholder="ご住所" value="<?php echo h($add); ?>"></label>
              </div>
              <div class="formItem">
                <label>電話番号 ＊半角入力<span class="attention"><?php echo h($error_tel); ?></span><br>
                <input type="tel" name="tel" autocomplete="tel" placeholder="09012345678" value="<?php echo h($tel); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem photo">
                プロフィール写真<br>＊1MB以内(形式：jpg、png、gif)<span class="attention"><?php echo h($error_photo); ?></span><br>
                <div class="formFlex flexWrap">
                <label><input type="file" name="photo" enctype="multipart/form-data" class="photoUpload">ファイルを選択</label>
                <p class="photoName">選択されていません。</p>
                <button type="button" class="photoClear">選択ファイルをクリア</button>
                </div>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>プロフィール　＊600字以内<span class="attention"><?php echo h($error_profile); ?></span><br>
                <textarea name="profile" placeholder="プロフィール"><?php echo h($profile); ?></textarea></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>サイトURL<span class="attention"><?php echo h($error_url); ?></span><br>
                <input type="url" name="url" placeholder="https://www.circus.co.jp" value="<?php echo h($url); ?>"></label>
              </div><!-- /.formItem -->
              <div class="submitItem">
                <input type="submit" name="confirm" value="確 認" id="submitButton">
              </div><!-- /.submitItem -->
            </form><!-- /form -->
          </div><!-- /.formArea -->
        </div><!-- /.cWrapper -->
      </main><!-- /main -->

<?php include('footer_signup.php'); ?>