<!-- 値受け取り -->
<?php
    $user_id = $_GET["user_id"];
    $password = $_GET["password"];
    $start = $_GET["start"];
    $size = $_GET["size"];
?>

<!-- ログイン処理 -->

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
        $query = 'SELECT * FROM user WHERE user_id = :user_id AND password = :password';

        //SQL文セット
        // $pdo はインスタンス
        //$pdo内のprepareメソッドを使って安全にsql文を入れる
        $stmt = $pdo->prepare($query);

        // バインド
        // bindParam 変数を代入 execute()で値がクエリに反映されれる
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        $result = $stmt->fetchAll();
        
    }

    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }

    // データベース切断
    //finally {
    //    mysql_close($pdo);
    //}

?>

<?php
    if (empty($result)){
        echo 'ログインに失敗しました。';
        // 失敗したらログイン画面に戻る
        require_once 'index.html';
    } else {
        $user_name = $result[0]["name"];
        
        // product 商品の数を求める
        require_once 'get_product_number.php';

        require_once 'view_products.php';
    }   
?>


