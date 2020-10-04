        <?php include("parts/header.php");?>
        <!-- CreateTopic Start -->
        <div class="create_topic">
            <form action="create_result.php" method="POST">
                <div class="form">
                    <div class="title">
                        <p class="title_txt">スレッド作成</p>
                    </div>
                    <input type="text" name="title" class="input_txt" placeholder="ここにスレッドのタイトルを入れてね！">
                    <br>
                    <input type="text" name="admin_number" class="input_txt" placeholder="スレッド削除用の数字を入れてね！">
                    <br>
                    <input type="submit" value="作成！">
                </div>
            </form>
        </div>
        <?php include("parts/footer.php");?>
    </div>
</body>
</html>

<style>
    .input_txt{
        width: 300px;
        margin-bottom: 6px;
    }
    .form{
        margin-top: 10px;
        width: 500px;
        border: 1px solid #ffffff;
        border-radius: 15px;
        box-shadow: 15px;
    }
    .title{
        border-left: 3px solid red;
        margin: 30px 0 30px;
    }

    .title_txt{
        padding-left: 15px;
    }
</style>
