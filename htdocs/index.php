<?php
// エラー表示
ini_set('display_errors', 1);
// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=test_db;host=mysql';
$user = 'root';
$password = 'password';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo "データベース接続成功\n";
} catch (PDOException $e) {
    echo "データベース接続失敗: " . $e->getMessage() . "\n";
    exit();
}

// SQL文を準備します。変動なしのSQLならプレースホルダーは不要です（クエリでOK
$sql = 'SELECT * FROM users';
// PDOStatementクラスのインスタンスを生成します。
$prepare = $dbh->query($sql);

// 実行する
$prepare->execute();

// PDO::FETCH_ASSOCは、対応するカラム名がキーになった連想配列として取得します。
$results = $prepare->fetchAll(PDO::FETCH_ASSOC);

// 結果を出力
// var_dump($results);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<br><br>";

    foreach ($results as $result) {
        echo "名前：" . $result['name'];
        echo "<br>";
        echo "年齢：" . $result['age'];
        echo "<br>";
        echo "職業：" . $result['job'];
        echo "<br><br><hr><br>";
    }
    ?>
</body>
</html>
