<?php 

// Include the database connection file
include ('../database.php');

// Check if 'customerName' parameter is present in the URL
if (isset($_GET['customerName'])) {
  // Sanitize the 'customerName' parameter to prevent XSS attacks
  $customerName = htmlspecialchars($_GET['customerName']);

  // Prepare a SQL query to select appointments for the given customer name
  $getAppointmentQuery = $conn->prepare("SELECT * FROM APPOINTMENT WHERE customerName = ?");
  $getAppointmentQuery->bind_param("s", $customerName);
  $getAppointmentQuery->execute();
  
  // Get the result of the query
  $appointment = $getAppointmentQuery->get_result();

  // Check if any appointment is found
  if($appointment->num_rows > 0) {
    // Fetch the appointment details
    $appointment = $appointment->fetch_assoc();
    
    // Prepare a SQL query to update the appointment status to 'Cancelled'
    $cancellationQuery = $conn->prepare("UPDATE APPOINTMENT SET appointmentStatus = 'Cancelled' WHERE customerName = ?");
    $cancellationQuery->bind_param("s", $appointment['customerName']);

    // Execute the update query
    if($cancellationQuery->execute()) {
      // Notify the user of a successful cancellation and redirect to the appointment page
      echo "<script>
      alert('Appointment Successfully Cancelled.');
      window.location.href = '../appointmentPage.php';
      </script>";
    }
  } else {
    // Notify the user if no appointment was found and redirect to the appointment page
    echo "<script>
    alert('Appointment not Found.');
    window.location.href = '../appointmentPage.php';
    </script>";
  }
}

?>
