<!-- 今回できなかったもの -->
<!-- 〇１、削除はできたものの、同じ内容だと、消えてしまう問題 別スレッドでも同じ内容で同じ削除番号だと削除されてしまう->ifでできたのか　もしくは単純にテーブル構造　じゃなくて、今までコメント内容で、消すものを決めてたけど、データベースの方のコメントに紐づけされてるidが固有のものだからそっちで合わせた -->
<!-- 〇２、削除時のアラート発行　jsで書こうとしたが、上手く動作しない       できた->単純に読み込みミス-->
<!-- 　３、phpのincludeで、cssの読み込みを分けることができなかった index.php と show.php ->結局style.cssに全部つっこんだ-->

<?php
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
        $stmt=$pdo->query("SELECT * FROM title");

    } catch (PDOException $e) {

        // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
;?>
        <?php include("parts/header.php");?>
        <!-- CreateTopic Start -->
        <div class="create_topic">
            &nbsp;
            <p>・スレッド作成は<a href="create.php"><strong>こちら</strong></a>から！</p>
        </div>
        <!-- Main Start -->
        <main>
            <div class="title">
                <p class="title_txt">スレッド一覧</p>
            </div>
            <ul>
                <?php
                    foreach($stmt as $key){
                        echo "<li>"."<a href='show.php?id={$key['id']}'>".$key['title']."</a>"."</li>";
                    }
                ;?>
            </ul>
        </main>
        <!-- CreateTopic Start -->
        <div class="create_topic">
            <div class="title">
                <p class="title_txt">スレッド作成</p>
            </div>
            <p class="txt">・スレッド作成は<a href="create.php"><strong>こちら</strong></a>から！</p>
        </div>
        <?php include("parts/footer.php");?>
    </div>
</body>
</html>
