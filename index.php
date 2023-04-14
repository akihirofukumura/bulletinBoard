<?php

$comment_array = array();

// DB接続
try {
  $pdo = new PDO('mysql:host=localhost;dbname=bulletin_b',"root","root");
} catch (PDOException $e) {
  echo $e->getMessage("s");
}

// formを打ち込んだとき
if (!empty($_POST["btn"])) {
  $postDate = date("Y-m-d H:i:s");

  try {
    $stmt = $pdo->prepare("INSERT INTO `bb_table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
    $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_POST["comment"], PDO::PARAM_STR);
    $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);
  
    $stmt -> execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    
}
// emptyという関数は、この中に入れる値が「空か」を判定する。
// 今回の場合は「空＝trure」ではなく「書き込むボタンを押す」ということは値があるため「空でないとき＝true」にしたいから！empty。


// DBからコメントデータを取得
  $sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `bb_table`";
  $comment_array = $pdo->query($sql);
  //「->」アロー演算子 はその左辺にはクラスのインスタンスを取り、右辺には左辺のクラスが持つプロパティやメソッドを指定しプロパティへのアクセス・メソッドの呼び出しを実行します。
  // 「クラス」は設計書のようなもの。
  // 「インスタンス」は実際に作ること。 ex)家を作る設計書がクラス。実際に立てるのがインスタンス
  
  // DBの接続を閉じる
  $pdo = null;
?> 

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bulletinboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <div class = "container bg-info w-50 h-50  text-white">
      <section>
        <?php foreach($comment_array as $comment):?>
          <article>
            <div class = "d-flex">
              <span>name:</span>
              <p><?php echo $comment["username"];?></p>
              <time><?php echo $comment["postDate"];?></time>
            </div>
            <p><?php echo $comment["comment"];?></p>
          </article>
        <?php endforeach;?>
      </section>
    </div>
    <div class = "container bg-secondary w-50">
      <form action="" method="post" enctype="multipart/form-data">
        <div class ="text-center pt-3">
          <input type="submit" value="writting" name = "btn">
          <label for="">name:</label>
          <input type="text" name="username">
        </div>
        <div class="text-center pt-2 pb-2">
          <textarea name="comment" id="" cols="50" rows="5"></textarea>
        </div>
      </form>
    </div>
  </body>
</html>
