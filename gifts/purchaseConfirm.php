<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_POST["payment"]) && !isset($_SESSION["payment"])){
  header("Location:purchase.php");
  exit();
}

$_POST = checkInput( $_POST );
$payment = isset($_POST['payment']) ? $_POST['payment'] : NULL;
$addressee = isset($_POST['addressee']) ? $_POST['addressee'] : NULL;
$postcode2 = isset($_POST['postcode2']) ? $_POST['postcode2'] : NULL;
$add2 = isset($_POST['add2']) ? $_POST['add2'] : NULL;

$addressee = trim($addressee);
$addressee = mb_convert_kana($addressee,"S");
$postcode2 = trim($postcode2);
$postcode2 = mb_convert_kana($postcode2,"n");
$postcode2 = str_replace(array('-', 'ー', '−', '―', '‐'), '', $postcode2);
$add2 = trim($add2);
$add2 = mb_convert_kana($add2,"a");
$add2 = str_replace(array('-', 'ー', '−', '―', '‐'), '-', $add2);

$error = array();
if ($payment == '') {
  $error['payment'] = '　＊お支払い方法を入力してください。';
}
if ($postcode2 != '' && !preg_match('/^(\d{3}-{1}\d{4})|(\d{7})$/', $postcode2)) {
  $error['postcode2'] = '　＊郵便番号の形式が正しくありません。';
}

$_SESSION["payment"] = $payment;
$_SESSION["addressee"] = $addressee;
$_SESSION["postcode2"] = $postcode2;
$_SESSION["add2"] = $add2;

if (count($error) > 0) {
  header("Location: purchase.php");
  exit();
}
?>

<?php include('header_purchase.php'); ?>
      <main>
        <div class="purchase">
          <h2 class="sectionTitle">購入手続き</h2>
          <p class="purchaseSentence">ご購入内容をご確認ください。<br>
            よろしければ購入ボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>お支払い方法</dt>
              <dd><?php echo $payment; ?></dd>
            </dl>
            <dl>
              <dt>お宛名</dt>
              <dd><?php echo $addressee; ?>様宛</dd>
            </dl>
            <dl>
              <dt>宛先郵便番号</dt>
              <dd><?php echo $postcode2; ?></dd>
            </dl>
            <dl>
              <dt>宛先ご住所</dt>
              <dd><?php echo $add2; ?></dd>
            </dl>
            <div class="submitItem"> 
              <a href="purchase.php" class="backButton">戻 る</a>
              <form action="purchaseComplete.php" method="post">
                <input type="submit" name="submit" value="購入する" id="submitButton">
              </form><!-- /form -->
            </div><!-- /.submitItem -->
          </div><!-- /.confirmArea -->
        </div><!-- /.purchase -->
      </main><!-- /main -->
<?php include('footer_purchase.php'); ?>