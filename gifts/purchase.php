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
  $error['login'] = '＊ログインしてください。';
  $_SESSION["error"] = $error;
	header("Location:$backpage");
  exit();
}

$payment = isset($_SESSION['payment']) ? $_SESSION['payment'] : NULL;
$addressee = isset($_SESSION['addressee']) ? $_SESSION['addressee'] : NULL;
$postcode2 = isset($_SESSION['postcode2']) ? $_SESSION['postcode2'] : NULL;
$add2 = isset($_SESSION['add2']) ? $_SESSION['add2'] : NULL;

$error_payment = isset($error['payment']) ? $error['payment'] : NULL;
$error_postcode2 = isset($error['postcode2']) ? $error['postcode2'] : NULL;
?>

<?php include('header_purchase.php'); ?>
      <main>
        <div class="purchase">
          <h2 class="sectionTitle">購入手続き</h2>
          <div class="cartIn">
            <form action="purchaseConfirm.php" method="POST">
              <div class="formItem radio">
                  お支払い方法を選択してください。<span class="required">必須</span><span class="attention"><?php echo h($error_payment); ?></span><br>
                  <span class="small">（※代引きは手数料が発生します。）</span><br>
                  <input type="radio" name="payment" value="振り込み" id="transfer" checked><label for="transfer" class="transfer" <?php if($payment == "振り込み") {echo "checked";} ?>>振り込み</label>
                  <input type="radio" name="payment" value="代引き" id="cod" <?php if($payment == "代引き") {echo "checked";} ?>><label for="cod" class="cod">代引き</label>
              </div><!-- /.formItem radio-->
              <div class="formItem">
                <p>※ご登録のご住所以外に送る場合は下記フォームにご入力ください。</p>
                <label>宛名<br>
                <input type="text" name="addressee" autocomplete="name" placeholder="山田　太郎" value="<?php echo h($addressee); ?>"></label>
              </div><!-- /.formItem -->
              <div class="formItem postCodeWrap">
                <label class="postCode">郵便番号<span class="attention"><?php echo h($error_postcode2); ?></span><br>
                <input type="text" name="postcode2" autocomplete="postal-code" placeholder="1234567" onKeyUp="AjaxZip3.zip2addr('postcode2', '', 'add2', 'add2');" value="<?php echo h($postcode2); ?>"></label>
              </div>
              <div class="formItem">
                <label>住所<br>
                <input type="text" name="add2" placeholder="ご住所" value="<?php echo h($add2); ?>"></label>
              </div>
              <div class="submitItem">
                <input type="submit" name="confirm" value="確 認" id="submitButton">
              </div><!-- /.submitItem -->
              <a href="#" onclick="javascript:window.history.back(-1);return false;" class="arrowBack linkBrown"><i class="fas fa-caret-left"></i>前のページに戻る</a>
            </form><!-- /form -->
          </div><!-- /.cartIn -->
        </div><!-- /.purchase -->
      </main><!-- /main -->
<?php include('footer_purchase.php'); ?>
