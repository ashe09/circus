<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
require 'functions.php';
header("X-FRAME-OPTIONS: SAMEORIGIN");

if (!isset($_SESSION["u_name"]) || !isset($_SESSION["email"]) || !isset($_SESSION["proposal"]) || !isset($_SESSION["profile"]) || !isset($_SESSION["url"])) {
  header("Location: entry.php");
  exit();
}

date_default_timezone_set('Asia/Tokyo'); 

$_POST = checkInput( $_POST );
$p_id = h($_SESSION["projectsID"]);
$u_name = h($_SESSION["u_name"]);
$u_name = h($_SESSION["u_name"]);
$email = h($_SESSION["email"]);
$file_name = h($_SESSION["proposal"]);
$fn = h($_SESSION["fn"]);
$profile = h($_SESSION["profile"]);
$url = h($_SESSION["url"]);
$u_id = h($_SESSION['user']);
$date = date("Y/m/d H:i:s");

require_once ("dbConnect.php");

// $sql = "CREATE TABLE if not exists entry_app (id int(11) not null primary key auto_increment,project_id int(11),u_name varchar(50),email varchar(50),proposal varchar(255),profile text,url text,u_id int(11),create_date datetime, FOREIGN KEY (u_id) REFERENCES users(id) ON UPDATE CASCADE
// ON DELETE SET NULL, FOREIGN KEY (project_id) REFERENCES projects(id) ON UPDATE CASCADE
// ON DELETE SET NULL)";
// $stmt = $db->prepare ( $sql );
// $stmt->execute ();

$sql = "INSERT INTO entry_app (project_id,u_name,email,proposal,profile,url,u_id,create_date) VALUES (:project_id,:u_name,:email,:proposal,:profile,:url,:u_id,:create_date)";
$stmt = $db->prepare ( $sql );
$stmt->bindParam ( ":project_id", $p_id, PDO::PARAM_STR );
$stmt->bindParam ( ":u_name", $u_name, PDO::PARAM_STR );
$stmt->bindParam ( ":email", $email, PDO::PARAM_STR );
$stmt->bindParam ( ":proposal", $fn, PDO::PARAM_STR );
$stmt->bindParam ( ":profile", $profile, PDO::PARAM_STR );
$stmt->bindParam ( ":url", $url, PDO::PARAM_STR );
$stmt->bindParam ( ":u_id", $u_id, PDO::PARAM_STR );
$stmt->bindParam ( ":create_date", $date, PDO::PARAM_STR );
$stmt->execute ();

$result = $stmt->rowCount ();

$db = null;

$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
if(!isset($user)) {
	$_SESSION = array();
	session_destroy();
}
?>

<?php include('header_entry.php'); ?>
      <main>
        <div class="entry">
          <h2 class="sectionTitle">Entry</h2>
          <div class="rWrapper">
            <p>エントリー手続きが完了いたしました。<br>
              選考を通過した方にはPartnersより連絡があります。</p>
            <a href="index.php" class="tapButton">Projectsページ</a>
          </div><!-- /.rWrapper -->
        </div><!-- /.entry -->
      </main><!-- /main -->
<?php include('footer_entry.php'); ?>

<?php
	unset($_SESSION['projectsID']);
	unset($_SESSION['u_name']);
	unset($_SESSION['email']);
	unset($_SESSION['proposal']);
	unset($_SESSION['fn']);
	unset($_SESSION['profile']);
  unset($_SESSION['url']);
	unset($_SESSION['error']);
?>