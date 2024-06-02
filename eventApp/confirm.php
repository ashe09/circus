<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");
if (!isset($_POST["eventTitle"]) && !isset($_SESSION["eventTitle"])) {
  header("Location:index.php");
  exit();
} 

$_POST = checkInput( $_POST );

$eventTitle = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : NULL;
$date = isset($_POST['date']) ? $_POST['date'] : NULL;
$time = isset($_POST['time']) ? $_POST['time'] : NULL;
$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
$medium = isset($_POST['medium']) ? $_POST['medium'] : NULL;
$comment = isset($_POST['comment']) ? $_POST['comment'] : NULL;

$name = trim($name);
$name = mb_convert_kana($name,"S");
$email = trim($email);
$tel = trim($tel);
$tel = str_replace(array('-', 'ー', '−', '―', '‐'), '', $tel);
$tel = mb_convert_kana($tel,"a");
$comment = trim($comment);

$error = array();
if ($eventTitle == '選択してください') {
  $error['eventTitle'] = '＊イベントの種類を選択してください。';
}
if ($date == '') {
  $error['date'] = '　＊日時を入力してください。';
}
if ($time == '') {
  $error['time'] = '　＊時間を入力してください。';
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

$_SESSION["eventTitle"] = $eventTitle;
$_SESSION["date"] = $date;
$_SESSION["time"] = $time;
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION["tel"] = $tel;
$_SESSION["medium"] = $medium;
$_SESSION["comment"] = $comment;
$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location: index.php");
  exit();
}
?>

<?php include('header_eventApp.php'); ?>
      <main>
        <div class="cWrapper">
          <h2 class="sectionTitle">Application for Events</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ送信ボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>イベント名</dt>
              <dd><?php echo $eventTitle; ?></span></dd>
            </dl>
            <dl>
              <dt>日付</dt>
              <dd><?php echo $date; ?></dd>
            </dl>
            <dl>
              <dt>時間</dt>
              <dd><?php echo $time; ?></dd>
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
              <dt>イベントを何で<span class="newLine960">お知りになりましたか？</span></dt>
              <dd>
              <?php
              if($_POST){
                if(!empty($medium)){
                post_print();
                }
              }
              ?>
              </dd>
            </dl>
            <dl>
              <dt>備考</dt>
              <dd class="content"><?php echo nl2br($comment); ?></dd>
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
<?php include('footer_eventApp.php'); ?>

<?php
function post_print(){
$medium = array();
$medium = $_POST["medium"];
  foreach($medium as $m){ 
  echo $m."<br>";
  }
}
?>