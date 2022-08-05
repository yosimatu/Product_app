<!-- 何かここを経由する意味がない気がしてきた -->

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hoge</title>
</head>
<body>
    <!-- それぞれのボタンのpathを指定 -->
    <?php
        if(isset($_GET['next_Btn'])){
            //echo 'next_Btn';
            require_once 'next_btn_process.php';
        }
        elseif(isset($_GET['before_Btn'])){
            //echo 'before_Btn';
            require_once 'before_btn_process.php';
        }
        elseif(isset($_GET['delete_Btn'])){
            //echo 'delete_Btn';
            require_once 'delete_btn_process.php';
        }
        elseif(isset($_GET['update_Btn'])){
            //echo 'update_Btn';
            require_once 'update_btn_process.php';
        }
        elseif(isset($_GET['add_Btn'])){
            //echo 'add_Btn';
            require_once 'add_btn_process.php';
        }
        elseif(isset($_GET['search_Btn'])){
            //echo 'isset_Btn';
            require_once 'search_btn_process.php';
        }
    ?>
</body>
</html>
