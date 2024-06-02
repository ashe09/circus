<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
$error = array();
$backpage = $_SERVER['HTTP_REFERER'];

if(!isset($user)) {
  $error['login'] = '　＊ログインしてください。';
  $_SESSION["error"] = $error;
	header("Location:$backpage");
  exit();
}


$_POST = checkInput( $_POST );
$p_id = isset($_POST['projectsID']) ? $_POST['projectsID'] : NULL;
$_SESSION["projectsID"] = $p_id;

$p_id = isset($_SESSION['projectsID']) ? $_SESSION['projectsID'] : NULL;
$u_name = isset($_SESSION['u_name']) ? $_SESSION['u_name'] : NULL;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
$file_name = isset($_SESSION['proposal']) ? $_SESSION['proposal'] : NULL;
$profile = isset($_SESSION['profile']) ? $_SESSION['profile'] : NULL;
$url = isset($_SESSION['url']) ? $_SESSION['url'] : NULL;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;

$error_u_name = isset($error['u_name']) ? $error['u_name'] : NULL;
$error_email = isset($error['email']) ? $error['email'] : NULL;
$error_proposal = isset($error['proposal']) ? $error['proposal'] : NULL;
$error_profile = isset($error['profile']) ? $error['profile'] : NULL;
$error_url = isset($error['url']) ? $error['url'] : NULL;
?>

<?php include('header_entry.php'); ?>
      <main>
        <div class="entry">
          <h2 class="sectionTitle">Entry</h2>
          <p>必須項目のご入力と企画書の<span class="newLine560">提出をお願いいたします。</span></p>
          <div class="formArea">
            <form action="entryConfirm.php" method="post" enctype='multipart/form-data'>
              <div class="formItem">
                <label>ユーザー名<span class="required">必須</span><span class="attention"><?php echo h($error_u_name); ?></span><br>
                <input type="text" name="u_name" placeholder="ユーザー名" value="<?php echo h($u_name); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>メールアドレス<span class="required">必須</span><span class="attention"><?php echo h($error_email); ?></span><br>
                <input type="email" name="email" autocomplete="email" placeholder="yamada@gmail.com" value="<?php echo h($email); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem photo">
                企画書<span class="required">必須</span><br>＊2MB以内(形式：PDF、Word、Excel、PowerPoint)<span class="attention"><?php echo h($error_proposal); ?></span><br>
                <div class="formFlex flexWrap">
                <label><input type="file" name="proposal" enctype="multipart/form-data" class="photoUpload">ファイルを選択</label>
                <p class="photoName">選択されていません。</p>
                <button type="button" class="photoClear">選択ファイルをクリア</button>
                </div>
              </div>
              <div class="formItem">
                <label>プロフィール　＊600字以内<span class="attention"><?php echo h($error_profile); ?></span><br>
                <textarea name="profile" placeholder="プロフィール"><?php echo h($profile); ?></textarea></label>
              </div><!-- /.formItem -->
              <div class="formItem">
                <label>サイトURL<span class="attention"><?php echo h($error_url); ?></span><br>
                <input type="url" name="url" placeholder="https://www.circus.co.jp" value="<?php echo h($url); ?>"></label>
              </div><!-- /.formItem -->
              <div class="submitItem">
                <input type="hidden" name="projectsID" value="<?php echo h($p_id); ?>">
                <input type="submit" name="confirm" value="確 認" id="submitButton">
              </div><!-- /.submitItem -->
            </form><!-- /form -->
          </div><!-- /.formArea -->
          <a href="#" onclick="javascript:window.history.back(-1);return false;" class="arrowBack linkBrown"><i class="fas fa-caret-left"></i> 前のページに戻る</a>
        </div><!-- /.entry -->
      </main><!-- /main -->
<?php include('footer_entry.php'); ?>

<?php
if(isset($user)) {
	unset($_SESSION['p_id']);
	unset($_SESSION['u_name']);
	unset($_SESSION['email']);
	unset($_SESSION['proposal']);
	unset($_SESSION['profile']);
	unset($_SESSION['url']);
	unset($_SESSION['error']);
}
?>