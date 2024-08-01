<?php 
// Include the database connection file
include ('../database.php');

// Check if the request method is POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Sanitize user input to prevent XSS attacks
  $customerName = htmlspecialchars($_POST['customerName']);
  $customerNumber = htmlspecialchars($_POST['customerNumber']);
  $appointmentDate = htmlspecialchars($_POST['appointmentDate']);
  $appointmentTime = htmlspecialchars($_POST['appointmentTime']);
  // Format the time to 'H:i:s' format
  $appointmentTime = date('H:i:s', strtotime($appointmentTime));
  $assignedTechnicianID = htmlspecialchars($_POST['nailTechAssigned']);
  $appointmentStatus = 'Scheduled'; // Default status for a new appointment

  // Prepare an SQL query to insert a new appointment into the database
  $insertAppointmentQuery = $conn->prepare("INSERT INTO APPOINTMENT (customerName, customerPhone, empID, date, time, appointmentStatus) VALUES (?, ?, ?, ?, ?, ?)");
  
  // Bind parameters to the SQL query
  $insertAppointmentQuery->bind_param("ssssss", $customerName, $customerNumber, $assignedTechnicianID, $appointmentDate, $appointmentTime, $appointmentStatus);
  
  // Execute the query and check if it was successful
  if($insertAppointmentQuery->execute()) {
    // Notify the user of a successful appointment scheduling and redirect to the appointment page
    echo "<script>
    alert('Appointment Scheduled Successfully. Returning to Appointment Window');
    window.location.href='../appointmentPage.php';
    </script>";
  } else {
    // Notify the user of an unexpected error and redirect to the appointment page
    echo "<script>
    alert('An unexpected error occurred!');
    window.location.href='../appointmentPage.php';
    </script>";
  }
}

// Close the database connection and prepared statement
$conn->close();
$insertAppointmentQuery->close();
?>
