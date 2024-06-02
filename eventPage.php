<?php
session_start();
session_regenerate_id( TRUE );
ini_set('display_errors', 0);
header("X-FRAME-OPTIONS: SAMEORIGIN");
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">
    <title>CIRCUS</title>
    <meta name="author" content="CIRCUS">
    <meta name="description" content="「CIRCUS」はクリエイターやアーティストに特化したクラウドソーシングサービスです。作品やパフォーマンスなど幅広いジャンルの商品を簡単に売り買いできます。">
    <link rel="canonical" href="https://www.circus-creativeworld.com">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" type="image/png" href="images/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="icon-192x192.png">
    <link href="css/destyle.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
    <link href="css/service.css" rel="stylesheet">
    <link href="css/news.css" rel="stylesheet">
    <link href="css/eventPage.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  </head>
  <body id="top">
    <div class="wrapper">
      <header class="headButtons">
        <h1 class="logoButton"><a href="index.php"><img src="images/home_button.png" alt="circus Website"></a></h1>
        <div class="mcButtonArea">
					<?php
						if (isset($_SESSION['user'])) {
							echo '<a href="mypage/index.php" class="mcButtons mypageButton">マイページ</a>';
						}
					?>
					<!-- <a href="gifts/cartIn.php" class="mcButtons cartButton">買い物かご</a> -->
        </div>
        <div class="lsButtonArea">
          <div class="loBox">
            <button class="lsButtons l">ログイン</button>
            <?php
            if (isset($_SESSION['user'])) {
              echo '<form action="logout.php" method="post" id="logout">
              <input type="submit" name="logout" id="logout_form" value="ログアウト">
              </form>';
            }
            ?>
          </div>
          <a href="signup/index.php" class="lsButtons s">新規登録</a>
        </div>
        <button type="button" id="hamburger" class="hamburger hamFrame" aria-controls="headerNav" aria-expanded="false">
          <div class="line"></div>
          <div class="menu">MENU</div>
        </button><!-- /.hamberger -->
      </header><!-- /header -->
      <nav class="headerNav">
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="service.php">Service</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="gifts/index.php">Gifts</a></li>
          <li><a href="projects/index.php">Projects</a></li>
          <li><a href="contact/index.php">Contact</a></li>
        </ul>
      </nav><!-- /.headerNav -->
      <div class="blackBack"></div><!-- /.blackBack -->
      <div class="modal">
        <button class="close"><img src="images/grayClose.png" alt="close_button"></button>
        <div class="loginForm">
          <h2>ログイン</h2>
          <form action="mypage/index.php" method="post">
            <input type="email" name="email" autocomplete="email" placeholder="例）info@circus.co.jp" id="leForm" required></label>
            <input type="password" name="password" placeholder="パスワード" id="lpForm" required></label>
            <input type="submit" name="login" value="ログイン" id="loginButton">
            <p class="signupGuide">新規会員登録は<a href="signup/index.php">こちら</a></p>
          </form>
        </div><!-- /.loginForm -->
      </div><!-- /.modal -->
      <main>
        <div class="event">
          <h2 class="sectionTitle">Event</h2>
          <div class="eventWrap">
            <div class="eventItem">
              <p class="eventImg">
                <img src="images/event1.jpg" alt="">
              </p>
              <div class="eventContent">
                <dt class="eventTitle">9月オンラインセミナーの<span class="newLine">お知らせ</span></dt>
                <dd class="eventText">9月9日（水）19：00～「映像編集ソフトLuminaのカラーグレーディング講座」、9月25日（金）20:00～「アーティストのためのブランディングセミナー」を開催します。
                </dd>
                <table class="eventTable">
                  <tr><th class="first">「映像編集ソフトLuminaのカラーグレーディング講座」</th></tr>
                  <tr><td>カラーグレーディングとは色の調整をする作業です。映像の編集段階でカラーグレーディングを行うことにより、印象やクオリティが大きく左右されます。今回は初級者の方を対象に実践的なテクニックを説明します。</td></tr>
                  <tr><th>日時</th></tr>
                  <tr><td>9月9日（水）19：00～20:30　所要時間約90分</td></tr>
                  <tr><th>対象</th></tr>
                  <tr><td>映像編集ソフトLuminaを所有している初級者</td></tr>
                  <tr><th>定員</th></tr>
                  <tr><td>30名</td></tr>
                  <tr><th>費用</th></tr>
                  <tr><td>無料</td></tr>
                  <tr><th>注意事項</th></tr>
                  <tr><td class="last">本講座はZOOMを使用します。また実際に編集ソフトを使用しますのであらかじめご準備ください。申し込み完了後、講座当日までにメールにてZOOMミーティングIDをお送りします。</td></tr>
                </table><!-- /.eventTable -->
                <a href="eventApp/index.php" class="tapButton app">お申し込み</a>
                <table class="eventTable">
                  <tr><th class="first">「アーティストのためのブランディングセミナー」</th></tr>
                  <tr><td>クリエイターが自立して活動を続けるためには、作品制作だけでなく宣伝力や集客力が重要なポイントとなります。どのように差別化を図り知名度を高めるかについて講義します。</td></tr>
                  <tr><th>日時</th></tr>
                  <tr><td>9月25日（金）20：00～21:00　所要時間約60分</td></tr>
                  <tr><th>定員</th></tr>
                  <tr><td>50名</td></tr>
                  <tr><th>費用</th></tr>
                  <tr><td>無料</td></tr>
                  <tr><th>注意事項</th></tr>
                  <tr><td class="last">本講座はZOOMを使用します。申し込み完了後、講座当日までにメールにてZOOMミーティングIDをお送りします。</td></tr>
                </table><!-- /.eventTable -->
                <a href="eventApp/index.php" class="tapButton app">お申し込み</a>
              </div><!-- /.eventContent -->
            </div><!-- /.eventItem -->
            <div class="eventItem">
              <p class="eventImg">
                <img src="images/event2.jpg" alt="">
              </p>
              <div class="eventContent">
                <dl>
                  <dt class="eventTitle">CIRCUSオークション<span class="newLine">開始します！</span></dt>
                  <dd class="eventText">10月5日（月）より「第3回CIRCUSオークション」作品応募の申し込みを開始します。CIRCUSオークションとは会員登録しているArtistsから応募された作品をアートバイヤーが審査し、選ばれた作品をオークションに出品します。審査は3回にわたって行われ、最終選考ではプレゼンテーションをしていただきます。オークションには毎年業界の関係者も参加しますので、作品をアピールできる貴重な機会です。応募の詳細は近日発表しますのでお見逃しなく！
                  </dd>
                </dl>
              </div><!-- /.eventContent -->
            </div><!-- /.eventItem -->
            <div class="eventItem">
              <p class="eventImg">
                <img src="images/event3.jpg" alt="">
              </p>
              <div class="eventContent">
                <dl>
                  <dt class="eventTitle">「Creative University」</dt>
                  <dd class="eventText">8月30日（日）開催の「Creative University」に当社代表の北野が出演し、みなと現代美術館館長の森氏と対談します。「クリエイターの海外進出」をテーマに海外のアートマーケットの仕組みや歴史、日本のアートとのつながりについてお話します。「Creative University」への入場は無料です。詳しくは<span class="linkBlue">「Creative University」公式サイト<i class="fas fa-external-link-alt"></i></span>をチェック。
                  </dd>
                </dl>
              </div><!-- /.eventContent -->
            </div><!-- /.eventItem -->
          </div><!-- /.eventWrap -->
          <div class="paginationWrapper">
            <nav class="pagination">
             <ul>
              <li><a href="eventPage.php" class="pageBack pageNumber"><i class="fa fa-chevron-left"></i></a></li>
              <li><span aria-current="page" class="pageNumber current">1</span></li>
              <li><a class="pageNumber" href="#">2</a></li>
              <li><a class="pageNumber" href="#">3</a></li>
              <li><a href="#" class="pageNext pageNumber"><i class="fa fa-chevron-right"></i></a></li>
             </ul>
            </nav>
           </div><!-- /.pageNumber -->
        </div><!-- /.event -->
      </main><!-- /main -->
      <footer>
        <nav class="footerNav">
          <ul>
            <li><a href="about.php">About</a></li>
            <li><a href="service.php">Service</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="gifts/index.php">Gifts</a></li>
            <li><a href="projects/index.php">Projects</a></li>
            <li><a href="contact/index.php">Contact</a></li>
          </ul>
        </nav>
        <p id="pageTop"><a href="#top"></a></p>
        <p id="copyRight"><small>Copyright&copy; CIRCUS </small></p>
      </footer><!-- /footer -->
    </div><!-- /.wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>