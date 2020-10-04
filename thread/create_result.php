<?php
    // POSTでデータを保存
    $title = (string)filter_input(INPUT_POST, 'title');
    $admin_number = (string)filter_input(INPUT_POST, 'admin_number');
    if(empty($title) || empty($admin_number)){
        header("Location: create.php","TRUE",301);
        exit();
    }
    // データベースに接続
    try {
        /* リクエストから得たスーパーグローバル変数をチェックするなどの処理 */
        // データベースに接続
        $pdo = new PDO(
            'mysql:dbname=thread;host=localhost;charset=utf8mb4',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        /* データベースから値を取ってきたり， データを挿入したりする処理 */
        $stmt = $pdo -> prepare("INSERT INTO title (title, admin_number) VALUES (:title, :admin_number)");
        $params = array(':title' => $title, ':admin_number' => $admin_number);
        $stmt->execute($params);

    } catch (PDOException $e) {

        // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
    header("Location: index.php","TRUE",301);
    exit();
;?>
