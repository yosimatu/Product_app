<!-- 値受け取り -->
<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];  
            
    $product_id = $_GET["product_id"];
    $product_type = $_GET["product_type"];
    $product_name = $_GET["product_name"];
    $price = $_GET["price"];
    $stuation = $_GET["product_status"];
    $order_name = $_GET["order_name"];
?>

<!-- 商品情報更新 -->
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
        $query = 'UPDATE product set type_id=:product_type, products_name=:product_name, 
            price=:price, order_status=:stuation, order_user=:order_name where product_id=:product_id';
        //echo $query;
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_type', $product_type, PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stuation', $stuation, PDO::PARAM_INT);
        $stmt->bindParam(':order_name', $order_name);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
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
    require_once 'view_products.php';
?>