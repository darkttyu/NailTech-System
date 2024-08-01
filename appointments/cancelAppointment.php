<?php 

include ('../database.php');

if (isset($_GET['customerName'])){
  $customerName = htmlspecialchars($_GET['customerName']);

  $getAppointmentQuery = $conn->prepare("SELECT * FROM APPOINTMENT WHERE customerName = ?");
  $getAppointmentQuery->bind_param("s", $customerName);
  $getAppointmentQuery->execute();
  
  $appointment = $getAppointmentQuery->get_result();

  if($appointment->num_rows > 0) {
    $appointment = $appointment->fetch_assoc();
    $cancellationQuery = $conn->prepare("UPDATE APPOINTMENT SET appointmentStatus = 'Cancelled' WHERE customerName = ?");
    $cancellationQuery->bind_param("s", $appointment['customerName']);

    if($cancellationQuery->execute()) {
      echo "<script>
      alert('Appointment Successfully Cancelled.');
      window.location.href = '../appointmentPage.php';
      </script>";
    }
  } else {
    echo "<script>
    alert('Appointment not Found.');
    window.location.href = '../appointmentPage.php';
    </script>";
  }
}

?>
