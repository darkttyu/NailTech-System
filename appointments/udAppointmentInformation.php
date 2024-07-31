<?php
// Include database connection and search functionality
include ('../database.php');
include ('searchAppointment.php');

// Initialize update success flag
$update_success = null;

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve employee data from the POST request
    $empID = $_POST['empID'];
    $empName = $_POST['empName'];
    $empNumber = $_POST['empNumber'];
    $empStatus = $_POST['empStatus'];

    // Prepare and execute a query to retrieve the existing employee data
    $raw_query = $conn->prepare("SELECT * FROM EMPLOYEE WHERE EMPID = ?");
    $raw_query->bind_param("s", $empID);
    $raw_query->execute();
    $raw_data = $raw_query->get_result();

    // Check if the employee exists
    if ($raw_data->num_rows > 0) {
        // Fetch the existing employee data
        $raw_employee = $raw_data->fetch_assoc();

        // Update employee ID if it has changed
        if ($raw_employee['empID'] !== $empID) {
            $update_query = $conn->prepare("UPDATE EMPLOYEE SET EMPID = ? WHERE EMPID = ?");
            $update_query->bind_param("ss", $empID, $raw_employee['empID']);
            $update_query->execute();
            $update_query->close();
            $update_success = true;
        }

        // Update employee name if it has changed
        if ($raw_employee['empName'] !== $empName) {
            $update_query = $conn->prepare("UPDATE EMPLOYEE SET EMPNAME = ? WHERE EMPID = ?");
            $update_query->bind_param("ss", $empName, $raw_employee['empID']);
            $update_query->execute();
            $update_query->close();
            $update_success = true;
        }

        // Update employee phone number if it has changed
        if ($raw_employee['empNumber'] !== $empNumber) {
            $update_query = $conn->prepare("UPDATE EMPLOYEE SET EMPNUMBER = ? WHERE EMPID = ?");
            $update_query->bind_param("ss", $empNumber, $raw_employee['empID']);
            $update_query->execute();
            $update_query->close();
            $update_success = true;
        }

        // Update employee status if it has changed
        if ($raw_employee['empStatus'] !== $empStatus) {
            $update_query = $conn->prepare("UPDATE EMPLOYEE SET EMPSTATUS = ? WHERE EMPID = ?");
            $update_query->bind_param("ss", $empStatus, $raw_employee['empID']);
            $update_query->execute();
            $update_query->close();
            $update_success = true;
        }

        // If any updates were made, display a success message and redirect
        if ($update_success) {
            echo "<script>
                alert('Employee Information Updated Successfully! Returning to Employee Page.');
                window.location.href = '../employee_page.php';
            </script>";
        }
    } else {
        // If employee not found, display an error message and redirect
        echo "<script> 
            alert('Search for an Employee First. Data to Update not Found');
            window.location.href= 'emp_update.php';
        </script>";
    }
}
?>