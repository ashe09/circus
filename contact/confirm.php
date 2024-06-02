<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_POST["kind"]) && !isset($_SESSION["kind"])
 || !isset($_POST["name"]) && !isset($_SESSION["name"])
 || !isset($_POST["email"]) && !isset($_SESSION["email"])
 || !isset($_POST["inquiry"]) && !isset($_SESSION["inquiry"])) {
  header("Location:index.php");
  exit();
} 

$_POST = checkInput( $_POST );

$kind = isset($_POST['kind']) ? $_POST['kind'] : NULL;
$company = isset($_POST['company']) ? $_POST['company'] : NULL;
$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
$inquiry = isset($_POST['inquiry']) ? $_POST['inquiry'] : NULL;

$company = trim($company);
$name = trim($name);
$name = mb_convert_kana($name,"S");
$email = trim($email);
$tel = trim($tel);
$tel = str_replace(array('-', 'ー', '−', '―', '‐'), '', $tel);
$tel = mb_convert_kana($tel,"a");
$inquiry = trim($inquiry);

$error = array();
if ($kind == '選択してください') {
  $error['kind'] = '＊お問い合わせの種類を選択してください。';
}
if ($name == '') {
  $error['name'] = '＊お名前を入力してください。';
}
if ($email == '') {
  $error['email'] = '＊メールアドレスを入力してください。';
} else {
  $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
  if (!preg_match( $pattern, $email )) {
    $error['email'] = '＊メールアドレスの形式が正しくありません。';
  }
}
if ($tel != '' && preg_match( '/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $tel ) == 0 ) {
  $error['tel'] = '＊電話番号の形式が正しくありません。';
}
if ($inquiry == '') {
  $error['inquiry'] = '＊お問い合わせ内容を入力してください。';
}

$_SESSION["kind"] = $kind;
$_SESSION["company"] = $company;
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION["tel"] = $tel;
$_SESSION["inquiry"] = $inquiry;
$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location: index.php");
  exit();
}
?>

<?php include('header_contact.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Contact</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ送信ボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>お問い合わせの種類</dt>
              <dd><?php echo $kind; ?></dd>
            </dl>
            <dl>
              <dt>貴団体・貴社名</dt>
              <dd><?php echo $company; ?></dd>
            </dl>
            <dl>
              <dt>お名前</dt>
              <dd><?php echo $name; ?></dd>
            </dl>
            <dl>
              <dt>メールアドレス</dt>
              <dd><?php echo $email; ?></dd>
            </dl>
            <dl>
              <dt>電話番号</dt>
              <dd><?php echo $tel; ?></dd>
            </dl>
            <dl>
              <dt>お問合せ内容</dt>
              <dd class="content"><?php echo nl2br($inquiry); ?></dd>
            </dl>
            <div class="submitItem"> 
              <a href="index.php" class="backButton">戻 る</a>
              <form action="complete.php" method="post">
                <input type="submit" name="submit" value="送 信" id="submitButton">
              </form><!-- /form -->
            </div><!-- /.submitItem -->
          </div><!-- /.confirmArea -->
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_contact.php'); ?>
