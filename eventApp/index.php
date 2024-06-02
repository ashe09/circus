<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

$eventTitle = isset($_SESSION['eventTitle']) ? $_SESSION['eventTitle'] : NULL;
$date = isset($_SESSION['date']) ? $_SESSION['date'] : NULL;
$time = isset($_SESSION['time']) ? $_SESSION['time'] : NULL;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
$tel = isset($_SESSION['tel']) ? $_SESSION['tel'] : NULL;
$medium = isset($_SESSION['medium']) ? $_SESSION['medium'] : NULL;
$comment = isset($_SESSION['comment']) ? $_SESSION['comment'] : NULL;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;

$error_eventTitle = isset($error['eventTitle']) ? $error['eventTitle'] : NULL;
$error_date = isset($error['date']) ? $error['date'] : NULL;
$error_time = isset($error['time']) ? $error['time'] : NULL;
$error_name = isset($error['name']) ? $error['name'] : NULL;
$error_email = isset($error['email']) ? $error['email'] : NULL;
$error_tel = isset($error['tel']) ? $error['tel'] : NULL;
$error_inquiry = isset($error['inquiry']) ? $error['inquiry'] : NULL;
?>

<?php include('header_eventApp.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Application for Events</h2>
          <p>お申し込みは下記<span class="newLine560">フォームより受付します。</span><br>
            必須項目のご入力を<span class="newLine560">お願いいたします。</span></p>
            <div class="formArea">
              <form action="confirm.php" method="post">
                <div class="formItem cselect">
                  <label for="eventTitle">イベント名<span class="required">必須</span></label><br>
                  <select id="eventTitle" name="eventTitle">
                  <?php
                    $eventTitles = ["select" => "選択してください","lumina" => "Luminaカラーグレーディング講座","branding" => "アーティストのためのブランディングセミナー"];
                    foreach ($eventTitles as $key => $val) {
                      echo "<option value='$val'";
                        if ($eventTitle == $val) {
                      echo "selected>".$val."</option>";
                      } else {
                        echo ">".$val."</option>";
                      }
                    }
                  ?> 
                  </select>
                  <span class="attention"><?php echo $error_eventTitle; ?></span>
                </div><!-- /.formItem -->
                <div class="formItem radio">
                  日付<span class="required">必須</span><span class="attention"><?php echo $error_date; ?></span><br>
                  <input type="radio" name="date" value="9月9日 (水)" id="nine" <?php if($date == "9月9日 (水)") {echo " checked";} ?>><label for="nine" class="select01">9月9日 (水)</label>
                  <input type="radio" name="date" value="9月25日 (金)" id="twentyfifth" <?php if($date == "9月25日 (金)") {echo " checked";} ?>><label for="twentyfifth" class="select02">9月25日 (金)</label>
                </div><!-- /.formItem -->
                <div class="formItem radio">
                  時間<span class="required">必須</span><span class="attention"><?php echo $error_time; ?></span><br>
                  <input type="radio" name="time" value="19：00" id="nineteen" <?php if($time == "19：00") {echo " checked";} ?>><label for="nineteen" class="select01">19：00</label>
                  <input type="radio" name="time" value="20：00" id="twenty" <?php if($time == "20：00") {echo " checked";} ?>><label for="twenty" class="select02">20：00</label>
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
                <div class="formItem checkbox">
                  イベントを何でお知りになりましたか？ ＊複数回答可<br>
                  <?php
                    $media = ["web" => "当サイト","twitter" => "Twitter","facebook" => "Facebook","instagram" => "Instagram","other" => "その他"];
                    foreach($media as $key => $val){
                      echo "<input type='checkbox' id='$key' name='medium[]' value='$val'";
                      if (isset($_SESSION ['medium'] ) && in_array($val, $_SESSION ['medium'])) {
                        echo "checked><label for='$key'>".$val."</label>";
                      } else {
                        echo "><label for='$key'>".$val."</label>";
                      }
                    }
            	  	?>
                </div><!-- /.formItem -->
                <div class="formItem">
                  <label>備考<br>
                  <textarea name="comment" placeholder="何かご不明点などございましたらご記入ください。"><?php echo h($comment); ?></textarea></label>
                </div><!-- /.formItem -->
                <div class="submitItem">
                  <input type="submit" name="confirm" value="確 認" id="submitButton">
                </div><!-- /.submitItem -->
              </form><!-- /form -->
            </div><!-- /.formArea -->
        </div><!-- /.cWrapper -->
      </main><!-- /main -->
<?php include('footer_eventApp.php'); ?>

<?php
if(!isset($user)) {
	$_SESSION = array();
	session_destroy();
}
?>

<?php
if(isset($user)) {
	unset($_SESSION['eventTitle']);
	unset($_SESSION['date']);
	unset($_SESSION['time']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['tel']);
	unset($_SESSION['medium']);
	unset($_SESSION['comment']);
	unset($_SESSION['error']);
}
?>