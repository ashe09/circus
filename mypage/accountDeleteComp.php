<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");
$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

if(isset($_POST['deleteAC'])) {
  $_POST = checkInput( $_POST );
  $deleteAC = h($_POST['deleteAC']);
  require_once ("dbConnect.php");
  $stmt = $db->prepare('DELETE FROM users WHERE id = ?');
  $stmt->bindValue(1, $_SESSION['user']);
  $stmt->execute();
} else {
	header("Location:../index.php");
}

$_SESSION = array();
session_destroy();
?>

<?php include('header_mypage.php'); ?>
      <main>
        <div class="mypage cWrapper">
					<h2 class="sectionTitle">退会手続き</h2>
          <p>退会手続きを完了いたしました。<br>
          CIRCUSをご利用いただきありがとうございました。</p>
        </div><!-- /.mypage cWrapper-->
      </main><!-- /main -->
<?php include('footer_mypage.php'); ?>