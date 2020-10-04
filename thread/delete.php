<?php
    session_start();
    $title_id=$_SESSION['thread_id'];
    $id=$_POST['radio'];
    $delete_number=$_POST['delete_number'];
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
        $stmt=$pdo->query("DELETE FROM comment WHERE id='{$id}' AND delete_number={$delete_number}");
        header("Location: show.php?id={$_SESSION['thread_id']}","TRUE",301);
        exit();
    } catch (PDOException $e) {
        // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
;?>
