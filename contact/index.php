<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

$kind = isset($_SESSION['kind']) ? $_SESSION['kind'] : NULL;
$company = isset($_SESSION['company']) ? $_SESSION['company'] : NULL;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
$tel = isset($_SESSION['tel']) ? $_SESSION['tel'] : NULL;
$inquiry = isset($_SESSION['inquiry']) ? $_SESSION['inquiry'] : NULL;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;

$error_kind = isset($error['kind']) ? $error['kind'] : NULL;
$error_name = isset($error['name']) ? $error['name'] : NULL;
$error_email = isset($error['email']) ? $error['email'] : NULL;
$error_tel = isset($error['tel']) ? $error['tel'] : NULL;
$error_inquiry = isset($error['inquiry']) ? $error['inquiry'] : NULL;

if(!isset($user)) {
	$_SESSION = array();
	session_destroy();
} 
?>

<?php include('header_contact.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Contact</h2>
          <p>お問合せは下記フォームに<span class="newLine560">ご入力ください。</span><br>
            必須項目のご入力を<span class="newLine560">お願いいたします。</span></p>
            <div class="formArea">
              <form action="confirm.php" method="post">
                <div class="formItem cselect">
                  <label for="kind">お問い合わせの種類<span class="required">必須</span></label><br>
                    <select id="kind" name="kind">
                    <?php
                    $kinds = ["select" => "選択してください","service" => "サービスについて","event" => "イベントについて","else" => "その他のお問い合わせ"];
                    foreach ($kinds as $key => $val) {
                      echo "<option value='$val'";
                        if ($kind == $val) {
                      echo " selected>".$val."</option>";
                      } else {
                        echo ">".$val."</option>";
                      }
                    }
                    ?>
                    </select>
                    <span class="attention"><?php echo h($error_kind); ?></span>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>貴団体・貴社名<br>
                  <input type="text" name="company" autocomplete="name" placeholder="貴団体・貴社名" value="<?php echo h($company); ?>"></label>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>お名前<span class="required">必須</span><br>
                  <input type="text" name="name" autocomplete="name" placeholder="山田　太郎" value="<?php echo h($name); ?>"></label>
                  <span class="attention"><?php echo h($error_name); ?></span>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>メールアドレス<span class="required">必須</span><br>
                  <input type="email" name="email" autocomplete="email" placeholder="yamada@gmail.com" value="<?php echo h($email); ?>"></label>
                  <span class="attention"><?php echo h($error_email); ?></span>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>電話番号 ＊半角入力<br>
                  <input type="tel" name="tel" autocomplete="tel" placeholder="09012345678" value="<?php echo h($tel); ?>"></label>
                  <span class="attention"><?php echo h($error_tel); ?></span>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>お問合せ内容<span class="required">必須</span><br>
                  <textarea name="inquiry" placeholder="お問い合わせ内容"><?php echo h($inquiry); ?></textarea></label>
                  <span class="attention"><?php echo h($error_inquiry); ?></span>
                </div><!-- /.formItem -->
                <div class="submitItem">
                  <input type="submit" name="confirm" value="確 認" id="submitButton">
                </div><!-- /.submitItem -->
              </form><!-- /form -->
            </div><!-- /.formArea -->
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_contact.php'); ?>

<?php
if(isset($user)) {
	unset($_SESSION['kind']);
	unset($_SESSION['company']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['tel']);
	unset($_SESSION['inquiry']);
	unset($_SESSION['error']);
}
?>