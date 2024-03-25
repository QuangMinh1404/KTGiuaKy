<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container form div {
            margin-bottom: 15px;
        }
        .login-container form label {
            font-weight: bold;
            color: #555;
        }
        .login-container form input[type="text"],
        .login-container form input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        .login-container form input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>  
        <form method="post" action="login.php">
            <div>
                <label for="username">Tài khoản:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Đăng nhập">
            </div>
        </form>
        <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<body>
    <?php
        require "connect.php";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }
        
        // Xử lý đăng nhập
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username1 = $_POST["username"];
            $password1 = $_POST["password"];
        
            // Truy vấn kiểm tra tài khoản và mật khẩu trong cơ sở dữ liệu
            $sql = "SELECT id, username, password, role FROM user WHERE username = '$username1'";
            $result = $conn->query($sql);
        
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($password1 == $row["password"]) {
                    // Đăng nhập thành công
                    session_start();
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["role"] = $row["role"];
        
                    // Chuyển hướng đến trang sau khi đăng nhập thành công
                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = "Sai tài khoản hoặc mật khẩu.";
                }
            } else {
                $error_message = "Sai tài khoản hoặc mật khẩu.";
            }
        }

        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        $conn->close();
    ?>

    </form>
</body>
</html>
