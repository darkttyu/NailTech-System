<?php 
include ('../database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $customerName = htmlspecialchars($_POST['customerName']);
  $customerNumber = htmlspecialchars($_POST['customerNumber']);
  $appointmentDate = htmlspecialchars($_POST['appointmentDate']);
  $appointmentTime = htmlspecialchars($_POST['appointmentTime']);
  $appointmentTime = date('H:i:s', strtotime($appointmentTime));
  $assignedTechnicianID = htmlspecialchars($_POST['nailTechAssigned']);
  $appointmentStatus = 'Scheduled';

  $insertAppointmentQuery = $conn->prepare("INSERT INTO APPOINTMENT (customerName, customerPhone, empID, date, time, appointmentStatus) VALUES (?, ?, ?, ?, ?, ?)");
  
  $insertAppointmentQuery->bind_param("ssssss", $customerName, $customerNumber, $assignedTechnicianID, $appointmentDate, $appointmentTime, $appointmentStatus);
  
  if($insertAppointmentQuery->execute()) {
    echo "<script>
    alert('Appointment Scheduled Succesfully. Returning to Appointment Window');
    window.location.href='../appointmentPage.php';
    </script>";
  } else {
    echo "<script>
    alert('An unexpected error occured!');
    window.location.href='../appointmentPage.php';
    </script>";
  }
}

$conn->close();
$insertAppointmentQuery->close();

?>