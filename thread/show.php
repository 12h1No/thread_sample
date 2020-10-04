<?php
    session_start();
    //URLからidデータを取得する
    $thread_id = (string)filter_input(INPUT_GET, 'id');
    $_SESSION['thread_id']=$thread_id;
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
        $stmt=$pdo->prepare("SELECT * FROM title LEFT JOIN comment ON title.id=comment.title_id WHERE title.id={$thread_id}");
        $stmt->execute();
    } catch (PDOException $e) {
        // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
;?>

        <?php
            include("parts/header.php");
        ;?>
        <!-- Thread Start -->
        <main>
            <div class="title">
                <p class="title_txt">
                    <?php
                        $all=$stmt->fetchAll(PDO::FETCH_ASSOC);
                         foreach($all as $row){
                            $thread_title= $row['title'];
                        }
                        // Show ThreadTitle
                        echo $thread_title;
                    ;?>
                </p>
            </div>
            <div class="thread_body">
                <div class="thread_content">
                    <form action="delete.php" method="POST" onsubmit="checkSubmit()">
                        <ol>
                        <?php
                            $check=0;
                            foreach($all as $row){
                                if(!$row['body']==0){
                                    echo "<li>";
                                    echo h($row['name']);
                                    echo "&nbsp";
                                    echo h($row['time']);
                                    echo "<input type='radio' name='radio' value='{$row['id']}'>";
                                    // 前は、                               value='{$row['body']}'だった
                                    echo "<br/>";
                                    echo h($row['body']);
                                    echo "<br/>";
                                    echo "<br/>";
                                }
                            }
                        ;?>
                        </ol>
                        <div class="delete">
                            <p>＜チェックしたものを削除する＞</p>
                            <input type="text" name="delete_number" placeholder="削除番号">
                            <input type="submit" value="削除" id="delete" >
                        </div>
                    </form>
                </div>
            </div>

        </main>
        <div class="comment">
            <div class="title">
                <p class="title_txt">
                    この下からコメントを追加できるよ！
                </p>
            </div>
            <form action="show_result.php" method="POST">
                <input type="text" name="name" class="short" placeholder="投稿者名">
                <br>
                <textarea type="text" name="body" class="long" placeholder="コメント"></textarea>
                <br>
                <input type="text" name="delete_number" class="short" placeholder="コメント削除用:数字で入力してください">
                <br>
                <input type="submit" value="投稿！">
            </form>
        </div>
        <?php include("parts/footer.php");?>
    </div>

</body>
</html>
