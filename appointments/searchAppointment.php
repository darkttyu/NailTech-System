<?php
// Include the database connection file
include('../database.php');

// Initialize variable to store appointment data
$appointment = null;

// Check if the request method is GET and 'searchedName' parameter is present
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['searchedName'])) {
    // Sanitize user input and prepare search query with wildcard for partial matching
    $search_query = '%' . $_GET['searchedName'] . '%';

    // Prepare SQL query to search for appointment by customer name
    $getAppointment = "SELECT * FROM APPOINTMENT WHERE customerName LIKE ?";
    $getAppointmentInfo = $conn->prepare($getAppointment);
    $getAppointmentInfo->bind_param("s", $search_query);
    $getAppointmentInfo->execute();
    $appointmentSearch = $getAppointmentInfo->get_result();

    // Check if any appointments match the search query
    if ($appointmentSearch->num_rows > 0) {
        // Fetch the first appointment found (you may want to handle multiple results differently)
        $appointment = $appointmentSearch->fetch_assoc();
    } else {
        // If no appointments are found, alert the user and redirect to the update page
        echo "<script>
            alert('Appointment not found.');
            window.location.href = 'updateAppointment.php';
        </script>";
        exit();
    }
}

// Optional debugging code (commented out)
// echo '<pre>';
// print_r($appointment);
// echo '</pre>';

?>
