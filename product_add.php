<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];  

    $product_type = $_GET["product_type"];
    $product_name = $_GET["product_name"];
    $price = $_GET["price"];
    $order_date = date("Y-m-d");
    $stuation = $_GET["product_status"];
    $order_name = $_GET["order_name"];
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
        $query = 'INSERT INTO product(type_id,products_name,price,order_date,order_status,order_user) 
        values(:product_type, :product_name, :price, :order_date, :situation, :order_name)';
        //echo $query;
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_type', $product_type, PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':situation', $stuation, PDO::PARAM_INT);
        $stmt->bindParam(':order_name', $order_name);
        $stmt->execute();
        

    }
    
    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }

?>

<!-- 商品が追加されたので +1 -->
<?php
    $product_number = $product_number + 1;

    require_once 'view_products.php';
?>
