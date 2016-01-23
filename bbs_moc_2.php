<?php

    //データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8'); 

    $nickname = '';
    $comment = '';
    $id = '';
    //$_GET送信が行われた、編集処理を実行
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
      //編集したいデータを取得するSQL文を作成
      $sql = 'SELECT * FROM posts WHERE id ="'.$_GET['id'].'" ORDER BY created DESC';
      
      // //SQL文を実行
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $rec2 = $stmt->fetch(PDO::FETCH_ASSOC);
      $nickname = $rec2['nickname'];
      $comment = $rec2['comment'];
      $id = $rec2['id'];
    }

    //$_GET送信が行われた、削除処理を実行
    if(isset($_GET['action']) && $_GET['action'] == 'delite'){
      //削除したいデータを取得するSQL文を作成
      $id = $_GET['id'];
      $sql = 'DELETE FROM posts WHERE id = '.$id;
                    
      // //SQL文を実行
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
    }


    //POSTが入っていた場合、
    if(!empty($_POST) && isset($_POST)){
      // empty ― 変数が空であるかどうかを検査する
      // isset ― 変数がセットされていること、NULL でないことを検査する
      if(isset($_POST['update'])){
        //編集ボタンが押されたらアップデート
        $sql = 'UPDATE posts SET nickname="'.$_POST['nickname'].'",comment="'.$_POST['comment'].'",
        created=NOW() WHERE id='.$_POST['id'];

      } else {
        //通常のつぶやきボタンが押された時の処理
        $sql = 'INSERT INTO posts SET nickname="'.$_POST['nickname'].'",
        comment="'.$_POST['comment'].'",created=NOW()';
      }

        //SQL文実行
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        header('Location: bbs_moc_2.php');
        exit();
    }

        //SQL文作成と実行（SELECT文）
        $sql = 'SELECT * FROM posts WHERE 1 ORDER BY created DESC';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $posts = array();

        while(1){
          $rec = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($rec == false){
            break;
          }
          $posts[] = $rec;
        } 

        //データベースから切断
        $dbh = null; 
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-comments-o"></i></i> Oneline bbs</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
<!--                   <li class="hidden">
                      <a href="#page-top"></a>
                  </li>
                  <li class="page-scroll">
                      <a href="#portfolio">Portfolio</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#about">About</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#contact">Contact</a>
                  </li> -->
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">
        <form action="bbs_moc_2.php" method="post">
          <div class="form-group">
            <div class="input-group">
              <?php if(isset($_GET['action']) == 'edit'): ?>
               <input type="text" name="nickname" class="form-control"
                                       id="validate-text" placeholder="<?php echo $nickname; ?>"
                                         required>
              <?php else: ?>
                <input type="text" name="nickname" class="form-control"
                       id="validate-text" placeholder="nickname" required>
              <?php endif; ?>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
            
          </div>

          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <?php if(isset($_GET['action']) == 'edit'): ?>
              <textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="<?php echo $comment; ?>" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
              <?php else: ?>
              <textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="comment" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
              <?php endif; ?>
            </div>
          </div>

              <?php if(isset($_GET['action']) == 'edit'): ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="update" class="btn btn-primary col-xs-12" disabled>編集</button>
              <?php else: ?>
                  <button type="submit" name="insert" class="btn btn-primary col-xs-12" disabled>つぶやく</button>
              <?php endif; ?>

        </form>
      </div>

      <div class="col-md-8 content-margin-top">

        <div class="timeline-centered">

          <?php foreach ($posts as $post) { ?>
            <article class="timeline-entry">

                <div class="timeline-entry-inner">
                    <a href="bbs_moc_2.php?action=edit&id=<?php echo $post['id']; ?>">
                      <div class="timeline-icon bg-success">
                          <i class="fa fa-cogs"></i>
                          <i class="entypo-feather"></i>
                      </div>
                    </a>

                    <div class="timeline-label">
                        <h2><a href="#"><?php echo $post['nickname']; ?></a><span><?php echo $post['created']; ?></span></h2>
                        <p><?php echo $post['comment']; ?></p>
                        <a href="bbs_moc_2.php?action=delite&id=<?php echo $post['id']; ?>">
                          <i class="fa fa-trash-o fa-lg"></i>                          
                        </a>
                    </div>
                </div>

            </article>
          <?php } ?>

          <article class="timeline-entry begin">

              <div class="timeline-entry-inner">


                  <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                      <i class="entypo-flight"></i> +

                  </div>

              </div>

          </article>

        </div>

    </div>
  </div>

  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>



