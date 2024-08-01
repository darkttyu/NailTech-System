<?php
// Include database connection file
include('../database.php');

// Initialize employee variable
$appointment = null;

// Check if it's a GET request with a search query
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['searchedName'])) {
    // Prepare search query with wildcard for partial matching
    $search_query = '%' . $_GET['searchedName'] . '%';

    // Prepare and execute SQL query to search for employee by name
    $getAppointment = "SELECT * FROM APPOINTMENT WHERE customerName LIKE ?";
    $getAppointmentInfo = $conn->prepare($getAppointment);
    $getAppointmentInfo->bind_param("s", $search_query);
    $getAppointmentInfo->execute();
    $appointmentSearch = $getAppointmentInfo->get_result();

    // Check if employee is found
    if ($appointmentSearch->num_rows > 0) {
        // Fetch the first employee found (you might want to handle multiple results differently)
        $appointment = $appointmentSearch->fetch_assoc();
    } else {
        // Handle case where employee is not found
        echo "<script>
            alert('Appointment not found.');
            window.location.href = 'updateAppointment.php';
        </script>";
        exit();
    }
}

// echo '<pre>';
// print_r($appointment);
// echo '</pre>';

?>