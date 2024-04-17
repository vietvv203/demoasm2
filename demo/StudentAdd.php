<form method="post">
        <table>
        <button><a class="aaa" href="StudentList.php">Back</a></button>

            <caption><b>Add Student</b></caption>
            <tr>
                <td>Rollno</td>
                <td><input type="text" name="Rollno"/> </td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td><input type="text" name="Sname"/> </td>
            </tr>
            <tr>
                <td>Student Address</td>
                <td><input type="text" name="Address"/> </td>
            </tr>
            <tr>
                <td>Student Email</td>
                <td><input type="text" name="Email"/> </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Add" name="btnAdd"/>
                    <input type="reset" value="Cancel" name="btnCancel"/>
                    
                    
                    <?php
                    include "db_conn.php";
                    if(isset($_POST['btnAdd'])) {
                        $Rollno = $_POST['Rollno'];
                        $Sname = $_POST['Sname'];
                        $Address = $_POST['Address'];
                        $Email = $_POST['Email'];
                        if($Rollno=="" || $Sname=="" || $Address=="" || $Email=="") {
                            echo "(*) Fields cannot be empty";
                        } else {
                            $sql = "SELECT Rollno FROM students WHERE Rollno='$Rollno'";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)==0) {
                                $sql = "INSERT INTO students VALUES ('$Rollno', '$Sname', '$Address', '$Email')";
                                mysqli_query($conn,$sql);
                                header("Location: StudentList.php");
                                //echo '<meta http-equiv="refresh" content="0; URL=StudentList.php">';
                            } else {
                                echo "Student already exists";
                            }
                        }
                    }
                    ?>

                </td>
            </tr>
        </table>
        <style>
        body {
            background-color: #ffa31a; /* Màu nền xanh da trời */
        }
        form {
            width: 50%; /* Đặt chiều rộng của form */
            margin: 0 auto; /* Để căn giữa form */
            padding: 20px; /* Thêm khoảng cách giữa biên và nội dung form */
            background-color:  #ffbf80; /* Màu nền trắng */
            border-radius: 10px; /* Bo tròn góc */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
        }
        table {
            width: 100%;
        }
        caption {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px; /* Thêm khoảng cách dưới */
}
        td {
            padding: 5px;
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #80e5ff; /* Màu xanh lá cây */
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #006680; /* Màu xanh lá cây nhạt */
        }
        b{
            color: #4ddbff;
            font-size: 40px;
        }
    </style>
    </form>