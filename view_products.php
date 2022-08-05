<?php
    //echo 'startの値(完成後消す)は　'.$start;
    //echo '</p>';
    //echo 'product_numberの値は　'.$product_number;
    try {
        // データベースに接続
        $pdo = new PDO(
            // ホスト名、データベース名
            'mysql:host=localhost;dbname=apri04;',
            // ユーザー名
            'root',
            // パスワード
            '',
            // レコード列名をキーとして取得させる
            [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
        );

        // SQL文をセット
        // 5件だけ検索
        $query = 'select * from product order by product_id limit :begin, :size';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':begin', $start, PDO::PARAM_INT);
        $stmt->bindParam(':size', $size, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();    
    }

    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    
</head>
<body>
    <p><a href="index.html">ログイン画面へ</a></p>
    <p>ようこそ <?php echo $user_name; ?> さん</p>

    <form action="btn_path.php" method="get">
        <?php foreach($result as $row) {?>
            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
            <input type="hidden" name="start" value="<?php echo $start; ?>">
            <input type="hidden" name="size" value="<?php echo $size; ?>">
            <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
            <input type="hidden" name="product_id" value="<?php echo $row["product_id"]?>">
            <input type="submit" name="delete_Btn" value="削除">
            <input type="submit" name="update_Btn" value="更新">
            <?php 
                echo '　';
                echo $row["products_name"];
                echo '　';
                echo $row["price"];
                echo '円';
                echo '</p>';
            ?>
        <?php } ?>
    </form>

    <form action="btn_path.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="start" value="<?php echo $start; ?>">
        <input type="hidden" name="size" value="<?php echo $size; ?>">
        <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
        <input type="submit" name="before_Btn" value="前へ">
        <input type="submit" name="next_Btn" value="次へ">
    </form>

    <form action="btn_path.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="start" value="<?php echo $start; ?>">
        <input type="hidden" name="size" value="<?php echo $size; ?>">
        <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
        <input type="submit" name="add_Btn" value="追加">
    </form>

    <form action="btn_path.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="start" value="<?php echo $start; ?>">
        <input type="hidden" name="size" value="<?php echo $size; ?>">
        <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
        商品検索 : 
        <input type="text" name="keyword" placeholder="商品名">
        <input type="submit" name="search_Btn" value="検索">
    </form>
    
</body>
</html>
