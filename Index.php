<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 50px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    // Paste your PHP code here
    ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Trang web của bạn</title>
    <style>
        ul.pagination {
            display: inline-block;
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        ul.pagination li {
            display: inline;
        }

        ul.pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin-left: -1px;
        }

        ul.pagination li a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        ul.pagination li a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1 style='text-align: center; color: blue;'>THÔNG TIN NHÂN VIÊN</h1>
    <?php
        require "connect.php";

        if($result->num_rows > 0){
            echo "<table style='display: flex;justify-content: center;'>
                <tr style='color: red;'>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Nơi sinh</th>
                    <th>Tên phòng</th>
                    <th>Lương</th>
                </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr'>
                        <td>".$row["MaNV"]."</td>
                        <td>".$row["TenNV"]."</td>
                        <td>";

                if ($row["Phai"] == "NAM") {
                    echo "<img src='img\man.jpg' alt='Man' style='height: 30px;width: 30px;'>";
                } elseif ($row["Phai"] == "NU") {
                    echo "<img src='img\women.jpg' alt='Woman' style='height: 30px;width: 30px;'>";
                }
                echo "  
                        </td>
                        <td>".$row["NoiSinh"]."</td>
                        <td>".$row["TenPhong"]."</td>
                        <td>".$row["Luong"]."</td>
                    </tr>";
            }

            echo "</table>";
            
            // Hiển thị phân trang
            echo "<div style='text-align: center;'>";
            if ($total_pages > 1) {
                echo "<ul class='pagination'>";
                if ($current_page > 1) {
                    echo "<li><a href='?page=".($current_page - 1)."'>Trang trước</a></li>";
                }
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<li".($page == $current_page ? " class='active'" : "")."><a href='?page=".$page."'>".$page."</a></li>";
                }
                if ($current_page < $total_pages) {
                    echo "<li><a href='?page=".($current_page + 1)."'>Trang Sau</a></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }else{
            echo "Không có nhân viên.";
        }
    ?>
</body>
</html>