<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin</title>
    <style>
        *{
            box-sizing: border-box;
        }
        .app{
            display: flex;
            justify-content: center;
        }
        .home{
            margin-top: 70px;
            width: 45%;
            padding: 0 15px;
            box-shadow: 1px 1px 15px rgb(77, 147, 238);
            border-radius: 4px;
        }
        .title{
            text-align: center;
        }
        .form-infor{
            display: flex;
            align-items: center;
        }
        .label{
            width: 15%;
        }
        .input{
            width: 85%;
            height: 30px;
            outline: none;
        }
        .add{
            text-align: center;
            padding: 15px 0;
            display: flex;
            justify-content: space-around;
        }
        .btn{
            width: 100px;
            height: 30px;
            background-color: rgb(69, 145, 231);
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn:hover{
            background-color: rgb(38, 212, 145);
            color: white;
        }
        .notification{
            text-align: center;
            font-size: 20px;
        }
        .add a{
            width: 100px;
            height: 30px;
            background-color: rgb(69, 145, 231);
            border: none;
            cursor: pointer;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: black;
        }
        .add a:hover{
            background-color: rgb(38, 212, 145);
            color: white;
        }
    </style>
</head>
<body>
    <div class="notification">
    <?php
        $conn = mysqli_connect("localhost","root","","datanews");
        if (mysqli_connect_errno()) {
            echo "Kết nối thất bại " . mysqli_connect_error();
        }
        $title = '';
        $image = '';
        $time = '';
        $details = '';
        mysqli_set_charset($conn, 'UTF8');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["title"])) {
                    $namsinh = $_POST['title'];
                }
                if (isset($_POST["image"])) {
                    $msv = $_POST['image'];
                }
                if (isset($_POST['time'])) {
                    $hoten = $_POST['time'];
                }
                if (isset($_POST['details'])) {
                    $name = $_POST['details'];
                }
                if (!empty($title)) {
                    $sql = "UPDATE `tinmoi` SET image='$image', time='$time', details='$details' WHERE title='$title'";

                } else {
                    $sql = "INSERT INTO tinmoi (title, image, time, details)
                                    VALUES ('{$title}', '{$image}', '{$time}', '{$details}')";
                }
            
                if ($conn->query($sql) === TRUE) {
                    echo "Đã sửa thông tin!!!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                if (isset($_GET['title'])) {
                    $msv = $_GET['title'];
                    $sql = "SELECT * FROM tinmoi WHERE title = {$title}";
                    $exe = mysqli_query($conn, $sql);
                    if ($exe) {
                        $result = mysqli_fetch_assoc($exe);
                    }
                }
            }
            $conn->close();
        ?>
    </div>
    <div class="app">
        <form action="sua.php" method="POST" class="home">
            <h2 class="title">Sửa thông tin</h2>
            <div class="form-infor">
                <h4 class="label">Tiêu đề</h4>
                <input type="text" class="input" name="title" value="<?php echo $title;?>">
            </div>
            <div class="form-infor">
                <h4 class="label">Ảnh</h4>
                <input type="text" class="input" name="image" value="<?= isset($result['image']) ? $result['image'] : ''; ?>" >  
            </div>
            <div class="form-infor">
                <h4 class="label">Thời gian</h4>
                <input type="text" class="input" name="time" value="<?= isset($result['time']) ? $result['time'] : ''; ?>">
            </div>
            <div class="form-infor">
                <h4 class="label">Chi tiết tin</h4>
                <input type="text" class="input" name="details" value="<?= isset($result['details']) ? $result['details'] : ''; ?>">
            </div>
            <div class="add">
                <button type="submit" class="btn">Đồng ý</button>
                <a href="information.php">
                    Trở về
                </a>
            </div>
        </form>
    </div>
</body>
</html>