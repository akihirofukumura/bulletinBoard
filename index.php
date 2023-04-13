<?php

$comment_array = array();

if (!empty($_POST["btn"])) {
  echo $_POST["username"];
  echo $_POST["comment"];
}
// emptyという関数は、この中に入れる値が「空か」を判定する。
// 今回の場合は「空＝trure」ではなく「書き込むボタンを押す」ということは値があるため「空でないとき＝true」にしたいから！empty。

// DB接続
try {
  $pdo = new PDO('mysql:host=localhost;dbname=bulletin_b',"root","root");
} catch (PDOException $e) {
  echo $e->getMessage();
}

// DBからコメントデータを取得
  $sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `bb_table`";
  $comment_array = $pdo->query($sql);

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
        <article>
          <div class = "d-flex">
            <span>name:</span>
            <p>newCode</p>
            <time>:7/15/2022</time>
          </div>
          <p>Comment</p>
        </article>
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
