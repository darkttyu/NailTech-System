<?php
// Include the database connection file
include('database.php');

// Prepare a SQL query to retrieve all appointments with the corresponding nail technician names
$appointmentQuery = "SELECT appointment.*, employee.empName AS nailTechName FROM APPOINTMENT appointment JOIN EMPLOYEE employee ON appointment.empID = employee.empID";

// Execute the query and store the result in $appointmentResult
$appointmentResult = $conn->query($appointmentQuery);

// Initialize an empty array to store appointment data
$appointments = [];

// Check if there are any appointments returned from the query
if ($appointmentResult->num_rows > 0) {
    // Iterate through each row of the result set
    while ($row = $appointmentResult->fetch_assoc()) {
        // Add the current appointment data to the $appointments array
        $appointments[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searchedAppointment'])) {
    
    $searchAppointment = "%" . $_GET['searchedAppointment'] . "%";

    $searchAppointmentQuery = "SELECT appointment.*, employee.empName AS nailTechName FROM APPOINTMENT appointment JOIN EMPLOYEE employee ON appointment.empID = employee.empID WHERE employee.empName LIKE ?";

    $getAppointments = $conn->prepare($searchAppointmentQuery);
    $getAppointments->bind_param("s", $searchAppointment);
    $getAppointments->execute();

    $appointment = $getAppointments->get_result();

    $appointments = [];

    if($appointment->num_rows > 0) {
        while($row = $appointment->fetch_assoc()) {
            $appointments[] = $row;
        }
    } else {
        // Display an error message and redirect to employee page
        echo "<script>
            alert('Nail Technician does not have any Appointments at the moment!');
            window.location.href = 'appointmentPage.php'; 
            </script>";
    }
}

/*
// Debugging output to check the values inside the appointments array
echo '<pre>'; // Format the output for better readability
print_r($appointments); // Use print_r() to display the array
echo '</pre>';

echo '<pre>'; // Format the output for better readability
var_dump($appointments); // Use var_dump() for detailed information
echo '</pre>';
*/

// Close the database connection
$conn->close();
?>
