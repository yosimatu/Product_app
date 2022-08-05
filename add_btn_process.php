<!-- 追加ボタンの処理 -->
<?php
    $user_name = $_GET["user_name"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $product_number = $_GET["product_number"];  
?>

<!-- 追加フォームの作成 -->
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>追加</title>
</head>
<body>
    <form action="product_add.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="start" value="<?php echo $start; ?>">
        <input type="hidden" name="size" value="<?php echo $size; ?>">
        <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">

        <!-- 商品タイプのlabel作成 ----------------------------------------->
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
                $query = 'select * from type';
                $stmt = $pdo->prepare($query);
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
        <label for="product_type">商品タイプ：</label>
   
        <select name="product_type">
            <?php
                foreach($result as $row){
            ?>
                <option value="<?php echo $row['type_id']; ?>">
                    <?php echo $row['name']; ?>
                </option>
            <?php
                }
            ?>
        </select>
        <p></p>

        <!-- 商品名のlabel作成 ----------------------------------------->
        <label for="product_name">商品名：</label>
        <input type="text" name="product_name">
        <p></p>

        <!-- 書品の値段のlabel作成 -------------------------------------->
        <label for="price">値段(円)：</label>
        <input type="text" name="price">
        <p></p>

        <!-- 商品の状態のlabel作成 ------------------------------------------------------>
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
                $query = 'select * from status';
                $stmt = $pdo->prepare($query);
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

        <p></p>

        <label for="product_status">状態：</label>
            <select name="product_status">
                <?php
                    foreach($result as $row){
                ?>
                    <option value="<?php echo $row['status_id']; ?>">
                        <?php echo $row['status']; ?>
                    </option>
                <?php
                    }
                ?>
            </select>

        <!-- 発注者のlabel作成 ------------------------------------------------------>
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
                $query = 'select * from user';
                $stmt = $pdo->prepare($query);
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

        <p></p>

        <label for="order_name">発注者：</label>
            <select name="order_name">
                <?php
                    foreach($result as $row){
                ?>
                    <option value="<?php echo $row['user_id']; ?>">
                        <?php echo $row['name']; ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        
        <!-- 決定ボタン作成 -------------------------------------------------->
        <p><input type="submit" name="decision_btn" value="決定"></p>

    </form>
</body>
</html>
