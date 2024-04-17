<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #ffa31a; /* Deep blue background for the body */
    color: #ffa31a; /* Adding white text for better readability */
    margin: 0;
    padding: 0;
    height: 100px;
    
}
.tb1{
    width: 100%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #ffa31a; /* Keeping table background white for contrast */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: scroll;
    height: 700px;
}
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    
  
}
th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
    color: black;
    margin: 5px;
    
}
th {
    background-color: #f2f2f2; /* Light grey header to maintain contrast */
    
}
caption {
    font-size: 30px;
    margin: 30px auto;
    color: #fff; /* Deep blue for caption text */
}
form {
    width: 1000%;
    margin: 20px auto;
    background-color: #fff; /* Keeping form background white for clarity */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
}
input[type="text"] {
    width: calc(100% - 20px);
    padding: 8px;

}
input[type="submit"], input[type="reset"] {
    padding: 10px 20px;
    background-color: #000066; /* Deep blue for buttons */
    color: white; /* White text for buttons to contrast with the deep blue */
    border: none;
    cursor: pointer;
    margin-top: 10px;
    border-radius: 3px;
    margin-left: 10px;
}
input[type="submit"]:hover, input[type="reset"]:hover {
    background-color: #00004d; /* Slightly darker blue for hover effect */
}
logout-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f44336;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

    </style>
    
</head>
<body>
    
    <?php
    // Database connection
    include "db_conn.php";
    
    // Add Student
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
                echo '<meta http-equiv="refresh" content="0; URL=StudentList.php">';
            } else {
echo "Student already exists";
            }
        }
    }

    // Delete Student
    if(isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $sql = "DELETE FROM students WHERE Rollno='$id'";
        if(mysqli_query($conn, $sql)) {
            header("Location: StudentList.php");
            exit();
        } else {
            echo "<h2>Error deleting record:</h2><p class='error-message'>" . mysqli_error($conn) . "</p>";
        }
        
    }
    ?>

    <!-- Student List Table -->
    <div class="tb1">
        <table>
            <button><a class="aaa" href="login.php">Log out</a></button>
            <caption><b>Student List</b></caption>
            <tr>
                <th>Rollno</th>
                <th>Student Fullname</th>
                <th>Address</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
        
        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $row['Rollno']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><a href="EditStudent.php?id=<?php echo $row['Rollno']; ?>">Edit</a></td>
                <td><a href="?delete_id=<?php echo $row['Rollno']; ?>">Delete</a></td>

            </tr>

        
            <?php } ?>

            <td><button><a href="StudentAdd.php">Add New Student</a></td></button>
            
            

        </table>

        <style>
            
        </style>
    </div>

   
</body>
</html>