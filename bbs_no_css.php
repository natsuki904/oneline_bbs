<?php

    //データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8'); 

    //SQL文作成(INSERT文)
    if(!empty($_POST) && isset($_POST)){
        //isset--変数の存在チェック
        //empty--存在した上で中身が0,null,''かチェックする

        //SQL文作成（INSERT文）
        $sql = 'INSERT INTO posts SET 
        nickname="'.$_POST['nickname'].'",
        comment="'.$_POST['comment'].'",
        created=NOW()';

        //INSERT文実行
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        header('Location: bbs_no_css.php');
        exit();
    }

        //SQL文作成と実行（SELECT文）
        $sql = 'SELECT * FROM posts WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $posts = array();

        while(1){
          $rec = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($rec == false){
            break;
          }
          $posts[] = $rec;
           // echo $rec['id'];
           // echo $rec['nickname'];
           // echo $rec['comment'];
           // echo $rec['created'];

        } 

        //データベースから切断
        $dbh = null; 
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs_no_css.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>
    <?php foreach ($posts as $post) { ?>
        <h2><a href="#"><?php echo $post['nickname']; ?></a>
         <span><?php echo $post['created'] ?></span></h2>
        <p><?php echo $post['comment']; ?></p>
    <?php } ?>
</body>
</html>
