<?php
    // セッションスタート
    session_start();
    // POSTでデータを保存
    $name = (string)filter_input(INPUT_POST, 'name');
    $body = (string)filter_input(INPUT_POST, 'body');
    $delete_number = (string)filter_input(INPUT_POST, 'delete_number');
    $title_id=$_SESSION['thread_id'];
    $error=array();
    // 投稿に関する注意　のスレッド時、コメントを受け付けない
    if($title_id==0){
        header("Location: show.php?id={$_SESSION['thread_id']}","TRUE",301);
        exit();
    }
    if(empty($name)){
        $name="名無し";
    }

    if(empty($body)){
        $error['body']="*コメントがありません";
    }

    if(empty($delete_number)){
        $error['delete_number']="*削除用番号がありません";
    }

    if(empty($error)){
        $_SESSION[$error]=$error;
        foreach ($error as $key) {
            echo $key;
        }
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
        $stmt = $pdo -> prepare("INSERT INTO comment (name,body,delete_number,title_id) VALUES (:name, :body,:delete_number,:title_id)");
        $params = array(':name' => $name, ':body' => $body, ':delete_number'=>$delete_number,'title_id'=>$title_id);
        $stmt->execute($params);

    } catch (PDOException $e) {

        // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
    header("Location: show.php?id={$_SESSION['thread_id']}","TRUE",301);
    exit();
;?>
