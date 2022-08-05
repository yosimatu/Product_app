<!-- 削除ボタンの処理 -->
<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"]; 
    $product_id = $_GET["product_id"];   
?>

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
        $query = 'DELETE FROM product WHERE product_id = :product_id;';

        //SQL文セット
        // $pdo はインスタンス
        //$pdo内のprepareメソッドを使って安全にsql文を入れる
        $stmt = $pdo->prepare($query);

        // バインド
        // bindParam 変数を代入 execute()で値がクエリに反映されれる
        $stmt->bindParam(':product_id', $product_id);

        $stmt->execute();
        
    }

    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }

?>

<?php
    // 商品を削除したので数を-1
    $product_number = $product_number - 1;

    require_once 'view_products.php';
?>