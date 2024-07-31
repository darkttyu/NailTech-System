<?php

include('employee_database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Sanitize input data
    $empID = htmlspecialchars($_GET['empID']);
    $empName = htmlspecialchars($_GET['empName']);
    $empNumber = htmlspecialchars($_GET['empNumber']);
    $empStatus = htmlspecialchars($_GET['empStatus']);

    // Check for duplicate employee ID
    $get_duplicate = $conn->prepare("SELECT empID FROM EMPLOYEE WHERE empID = ?");
    $get_duplicate->bind_param("s", $empID);
    $get_duplicate->execute();
    $get_duplicate->store_result();

    if ($get_duplicate->num_rows > 0) {
        // Display an error message and redirect
        echo "<script> 
            alert('Cannot Insert Employee. ID already taken!'); 
            window.location.href='emp_add.html';
        </script>";
        exit;
    } else {
        // Prepare and execute the insert query
        $insert_employee = $conn->prepare("INSERT INTO EMPLOYEE (empID, empName, empNumber, empStatus) VALUES (?, ?, ?, ?)");
        $insert_employee->bind_param("ssss", $empID, $empName, $empNumber, $empStatus);

        if ($insert_employee->execute()) {
            // Display a success message and redirect
            echo "<script>
                alert('Employee Successfully Inserted!')
                window.location.href='../employee.html'; 
            </script>";
        } else {
            // Display an error message and redirect
            echo "<script>
                alert('Insertion Error!')
                window.location.href='emp_add.html';
            </script>";
        }
    }

    // Close database connections
    $conn->close();
    $get_duplicate->close();
    $insert_employee->close();
}

?>