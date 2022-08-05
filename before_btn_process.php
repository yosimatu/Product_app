<!-- 前へボタンの処理 -->
<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];    
?>

<?php
    $start = $start - 5;
    if ($start < 0) {
        $start = 0;
    }
?>

<?php
    require_once 'view_products.php';
?>