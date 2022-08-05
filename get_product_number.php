<!-- 商品の個数を求める -->

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
        $query = 'SELECT COUNT(product_id) AS product_number FROM product';

        //SQL文セット
        // $pdo はインスタンス
        //$pdo内のprepareメソッドを使って安全にsql文を入れる
        $stmt = $pdo->prepare($query);

        // バインド
        // bindParam 変数を代入 execute()で値がクエリに反映されれる

        $stmt->execute();

        $result = $stmt->fetchAll();
        
        // 商品の数を取得
        $product_number = $result[0]["product_number"];
        
        // print_r($result);
        
        // echo $product_number;
        
    }

    catch (PDOEcxrption $e) {
        //例外が発生したら無視
        require_once 'exception_tpl.php';
        echo $e->getMessage();
        exit();
    }

?>