<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];

    $key_word = $_GET["keyword"];
?>

<p>検索ワード : <?php echo $key_word; ?></p>

<?php
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
        $query = 'select * from product where products_name LIKE :keyword';
        $stmt = $pdo->prepare($query);
        $key='%'.$key_word.'%';
        $stmt->bindParam(':keyword', $key);
        $stmt->execute();
        $result = $stmt->fetchAll();
        //print_r($result);   
    }

    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }
?>

<?php
    if (empty($result)){
        echo "該当する商品がありませんでした。";
    }else{
        echo '該当件数　'.count($result).'件';
        echo '</p>';
        foreach($result as $row){
            echo $row["products_name"];
            echo '　';
            echo $row["price"];
            echo '円';
            echo "</p>";
        }
    }
    
?>

<form action="search_to_view.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="start" value="<?php echo $start; ?>">
    <input type="hidden" name="size" value="<?php echo $size; ?>">
    <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
    <input type="submit" name="back_btn" value="戻る">
</form>