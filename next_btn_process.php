<!-- 次へボタンの処理 -->
<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];    
?>

<?php
    
    $start = $start + 5;
    // 商品の数が5の倍数のとき
    if ($product_number % 5 == 0){
        if ($product_number <= $start){
            $start = $start - 5;
        }
    }
    // 商品の数が5の倍数ではないとき
    else{
        if ($product_number < $start){
            $start = $start - 5;
        }
    }
?>

<?php
    require_once 'view_products.php';
?>