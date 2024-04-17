<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <button><a class="aaa" href="StudentList.php">Back</a></button>


    <style>
            body {
            font-family: Arial, sans-serif;
            background-color:  #ffa31a;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color:   #00b33c;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        caption {
            font-size: 1.2em;
            margin: 10px;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 5px;
        }
        input[type="submit"], a {
            padding: 10px 20px;
            background-color: #1ad1ff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            border-radius: 3px;
            margin-left: 10px;
        }
        button{
            padding: 11px 20px;
            background-color: #1ad1ff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            border-radius: 3px;
        }

        button:hover,  a:hover {
            background-color:  #b3f0ff;  
        }
        

        input[type="submit"]:hover, a:hover {
            background-color:  #b3f0ff;
        }
        .error {
            color: red;
        }
        b{
            color:white;
            font-size: 30px;
        }
        
    </style>
</head>
<body>
    <?php
    include "db_conn.php";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM students WHERE Rollno='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Invalid request.";
        exit();
    }

    if(isset($_POST['btnEdit'])) {
        $Rollno = $_POST['Rollno'];
        $Sname = $_POST['Sname'];
        $Address = $_POST['Address'];
        $Email = $_POST['Email'];
        if($Rollno=="" || $Sname=="" || $Address=="" || $Email=="") {
            echo "(*) Fields cannot be empty";
        } else {
            $sql = "UPDATE students SET Sname='$Sname', Address='$Address', Email='$Email' WHERE Rollno='$Rollno'";
            if(mysqli_query($conn, $sql)) {
                header("Location: StudentList.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
    ?>
<!-- Edit Student Form -->
    <form method="post">
        <table>
            <caption><b>Edit Student</b></caption>
            <input type="hidden" name="Rollno" value="<?php echo $row['Rollno']; ?>">
            <tr>
                <td>Rollno</td>
                <td><input type="text" name="Rollno" value="<?php echo $row['Rollno']; ?>" disabled/> </td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td><input type="text" name="Sname" value="<?php echo $row['Sname']; ?>"/> </td>
            </tr>
            <tr>
                <td>Student Address</td>
                <td><input type="text" name="Address" value="<?php echo $row['Address']; ?>"/> </td>
            </tr>
            <tr>
                <td>Student Email</td>
                <td><input type="text" name="Email" value="<?php echo $row['Email']; ?>"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit" value="Update" name="btnEdit">Update</button>
                    <a href="StudentList.php">Cancel</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>