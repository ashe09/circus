<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_POST["u_name"]) && !isset($_SESSION["u_name"])){
  header("Location:entry.php");
  exit();
} 

$p_id = isset($_SESSION['projectsID']) ? $_SESSION['projectsID'] : NULL;
$_POST = checkInput( $_POST );

$u_name = isset($_POST['u_name']) ? $_POST['u_name'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$file = isset($_FILES['proposal']) ? $_FILES['proposal'] : NULL;
$file_name = $file['name'];
$ex = strtolower(mb_strrchr($file_name,'.',FALSE));
$profile = isset($_POST['profile']) ? $_POST['profile'] : NULL;
$url = isset($_POST['url']) ? $_POST['url'] : NULL;

$u_name = trim($u_name);
$u_name = mb_convert_kana($u_name,"a");
$u_name = mb_convert_kana($u_name,"K");
$email = trim($email);
$profile = trim($profile);
$profile = mb_convert_kana($profile,"a");
$profile = mb_convert_kana($profile,"K");
$url = trim($url);

$error = array();
if ($u_name == '') {
  $error['u_name'] = '　＊ユーザー名を入力してください。';
}
if ($email == '') {
  $error['email'] = '　＊メールアドレスを入力してください。';
} else {
  $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
  if (!preg_match( $pattern, $email )) {
    $error['email'] = '　＊メールアドレスの形式が正しくありません。';
  }
}

$max_size = 1024*1024*2; //2MBサイズ
if (!empty($file_name)) {
  if(($file['type']!='application/pdf' 
	&& $file['type']!='application/x-pdf'
	&& $file['type']!='application/acrobat'
  && $file['type']!='application/msword'
  && $file['type']!='application/doc'
  && $file['type']!='application/doc'
  && $file['type']!='application/vnd.ms-excel'
  && $file['type']!='application/msexcel'
  && $file['type']!='application/xls'
  && $file['type']!='application/vnd.ms-powerpoint '
  && $file['type']!='application/mspowerpoint'
  && $file['type']!='application/ms-powerpoint')
	|| ($ex!=".pdf" && $ex!=".doc" && $ex!=".docx" && $ex!=".xlsx" && $ex!=".xls" && $ex!=".pptx" && $ex!=".ppt")){
    unlink($file['tmp_name']);
    $error['proposal'] = '　＊ファイルの形式が正しくありません。';
  } elseif ($file['size']>$max_size) {
    unlink($file['tmp_name']);
    $error['proposal'] = '　＊アップロードできるサイズを超えています。';
  } else {
    $directory = "proposal";
    $app_datetime=date('YmdHis');
    $fn=$app_datetime.$file['name'];

    if(!is_dir($directory)){mkdir($directory);}
    move_uploaded_file($file['tmp_name'],'./proposal/'.$fn);
  } 
} else {
	$error['proposal'] = '　＊ファイルをアップロードしてください。';
}
if (600 < mb_strlen($profile)) {
  $error['profile'] = '　＊内容は600字以内で入力してください。';
}
if ($url != '' && preg_match( '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $url ) == 0 ) {
  $error['url'] = '　＊urlの形式が正しくありません。';
}

$_SESSION["projectsID"] = $p_id;
$_SESSION["u_name"] = $u_name;
$_SESSION["email"] = $email;
$_SESSION["proposal"] = $file_name;
$_SESSION["fn"] = $fn;
$_SESSION["profile"] = $profile;
$_SESSION["url"] = $url;
$_SESSION["error"] = $error;

if (count($error) > 0) {
  header("Location:entry.php");
  exit();
}
?>

<?php include('header_entry.php'); ?>
      <main>
        <div class="entry">
          <h2 class="sectionTitle">Entry</h2>
          <p>入力内容をご確認ください。<br>
            よろしければ送信ボタンを<span class="newLine560">クリックしてください。</span></p>
          <div class="confirmArea">
            <dl>
              <dt>ユーザー名</dt>
              <dd><?php echo $u_name; ?></dd>
            </dl>
            <dl>
              <dt>メールアドレス</dt>
              <dd><?php echo $email; ?></dd>
            </dl>
            <dl>
              <dt>企画書</dt>
              <dd><?php echo $file_name; ?></dd>
            </dl>
            <dl>
              <dt>プロフィール</dt>
              <dd class="content"><?php echo nl2br($profile); ?></dd>
            </dl>
            <dl>
              <dt>サイトURL</dt>
              <dd><?php echo $url; ?></dd>
            </dl>
            <div class="submitItem"> 
              <a href="entry.php" class="backButton">戻 る</a>
              <form action="entryComplete.php" method="post">
                <input type="submit" name="submit" value="送 信" id="submitButton">
              </form><!-- /form -->
            </div><!-- /.submitItem -->
          </div><!-- /.confirmArea -->
        </div><!-- /.entry -->
      </main><!-- /main -->
<?php include('footer_entry.php'); ?>