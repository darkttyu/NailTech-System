<?php
// Include database connection and search functionality
include ('../database.php');
include ('searchAppointment.php');

// Initialize update success flag
$updateSuccess = null;

// echo '<pre>';
// print_r($_POST['customerName']);
// print_r($_POST['customerNumber']);
// print_r($_POST['nailTechAssigned']);
// echo '</pre>';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve employee data from the POST request
    $customerName = $_POST['customerName'];
    $customerNumber = $_POST['customerNumber'];
    $empID = $_POST['nailTechAssigned'];
    $date = $_POST['appointmentDate'];
    
    $time = $_POST['appointmentTime'];
    $time = date('H:i:s', strtotime($time));

    $appointmentStatus = $_POST['appointmentStatus'];

    // Prepare and execute a query to retrieve the existing employee data
    $rawQuery = $conn->prepare("SELECT * FROM APPOINTMENT WHERE customerName = ? OR customerPhone = ?");
    $rawQuery->bind_param("ss", $customerName, $customerNumber);
    $rawQuery->execute();
    $rawData = $rawQuery->get_result();

    // Check if the employee exists
    if ($rawData->num_rows > 0) {
        // Fetch the existing employee data
        $rawAppointment = $rawData->fetch_assoc();

        // Update employee ID if it has changed
        if ($rawAppointment['customerName'] !== $customerName) {
            $update_query = $conn->prepare("UPDATE APPOINTMENT SET CUSTOMERNAME = ? WHERE CUSTOMERNAME = ?");
            $update_query->bind_param("ss", $customerName, $rawAppointment['customerName']);
            $update_query->execute();
            $update_query->close();
            $updateSuccess = true;
        }

        // Update employee name if it has changed
        if ($rawAppointment['customerPhone'] !== $customerNumber) {
            $updateQuery = $conn->prepare("UPDATE APPOINTMENT SET CUSTOMERPHONE = ? WHERE CUSTOMERNAME = ?");
            $updateQuery->bind_param("ss", $customerNumber, $rawAppointment['customerName']);
            $updateQuery->execute();
            $updateQuery->close();
            $updateSuccess = true;
        }

        // Update employee phone number if it has changed
        if ($rawAppointment['empID'] !== $empID) {
            $updateQuery = $conn->prepare("UPDATE APPOINTMENT SET EMPID = ? WHERE CUSTOMERNAME = ?");
            $updateQuery->bind_param("ss", $empID, $rawAppointment['customerName']);
            $updateQuery->execute();
            $updateQuery->close();
            $updateSuccess = true;
        }

        // Update employee status if it has changed
        if ($rawAppointment['date'] !== $date) {
            $updateQuery = $conn->prepare("UPDATE APPOINTMENT SET DATE = ? WHERE CUSTOMERNAME = ?");
            $updateQuery->bind_param("ss", $date, $rawAppointment['customerName']);
            $updateQuery->execute();
            $updateQuery->close();
            $updateSuccess = true;
        }

        if ($rawAppointment['time'] !== $time) {
            $updateQuery = $conn->prepare("UPDATE APPOINTMENT SET TIME = ? WHERE CUSTOMERNAME = ?");
            $updateQuery->bind_param("ss", $time, $rawAppointment['customerName']);
            $updateQuery->execute();
            $updateQuery->close();
            $updateSuccess = true;
        }

        if ($rawAppointment['appointmentStatus'] !== $appointmentStatus) {
            $updateQuery = $conn->prepare("UPDATE APPOINTMENT SET APPOINTMENTSTATUS = ? WHERE CUSTOMERNAME = ?");
            $updateQuery->bind_param("ss", $appointmentStatus, $rawAppointment['customerName']);
            $updateQuery->execute();
            $updateQuery->close();
            $updateSuccess = true;
        }

        // If any updates were made, display a success message and redirect
        if ($updateSuccess) {
            echo "<script>
                alert('Appointment Information Updated Successfully! Returning to Appointment Page.');
                window.location.href = '../appointmentPage.php';
            </script>";
        }
    } else {
        // If employee not found, display an error message and redirect
        echo "<script> 
            alert('Search for an Appointment First. Data to Update not Found');
            window.location.href= 'updateAppointment.php';
        </script>";
    }
}
?>