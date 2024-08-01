<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="assets/logo.png" type="image/icon type">
        <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/appointmentStyle.css">
    <title>Employee Management</title>
</head>
<body>
        <div class="topnav">
            <img id="logo" src="/assets/logo.png"> 
            <a id="home" href="homepage.html"> HOME </a>
            <a id="employee" href="employeePage.php"> EMPLOYEE MANAGEMENT</a>
            <a id="appointment" href="appointmentPage.php"> APPOINTMENT SCHEDULING </a>
        </div>
        
        
        <div class="appointmentButtons">
             
            <form action="checkAppointmentButton.php" method="POST">
                <button id="setAppointment" name="Set" >SET AN APPOINTMENT</button>
                <button id="updateAppointment" name="Update" >UPDATE AN APPOINTMENT</button>
                <button id="cancelAppointment" name="Cancel" >CANCEL APPOINTMENT</button>
            </form>
            
            <form action="appointmentPage.php" method="GET">

                <input id="searchAppointment" name="searchedAppointment" type="search" placeholder="Search Appointment by Name..">

                <button id="searchIcon"> <i class="fas fa-search"></i> </button>

            </form>
        </div>

        <div class="appointmentContainer">
            <?php include 'retrieveAppointment.php';?>
            <table id="appointmentTable">
                
                <thead id="appointmentHeader">
                    <th>Customer Name:</th>
                    <th>Phone Number:</th>
                    <th>Nail Technician:</th>
                    <th>Date:</th>
                    <th>Time:</th>
                    <th>Appointment Status:</th>
                </thead>
                
                <?php foreach($appointments as $appointment): ?>
                <tr id="appointmentRow">
                    
                    <td data-customer-Name="<?php echo htmlspecialchars($appointment['customerName']); ?>" ><?php echo htmlspecialchars($appointment['customerName']); ?></td>
                    
                    <td data-customer-Phone="<?php echo htmlspecialchars($appointment['customerPhone']); ?>" ><?php echo htmlspecialchars($appointment['customerPhone']); ?></td>
                    
                    <td data-nailTech-Name="<?php echo htmlspecialchars($appointment['nailTechName']); ?>" ><?php echo htmlspecialchars($appointment['nailTechName']); ?></td>
                    
                    <td data-date="<?php echo htmlspecialchars($appointment['date']); ?>"><?php echo htmlspecialchars($appointment['date']); ?></td>
                    
                    <td data-customer-Phone="<?php echo htmlspecialchars($appointment['time']); ?>"><?php echo htmlspecialchars($appointment['time']); ?></td>
                    
                    <td data-customer-Phone="<?php echo htmlspecialchars($appointment['appointmentStatus']); ?>"><?php echo htmlspecialchars($appointment['appointmentStatus']); ?></td>

                </tr>
                <?php endforeach; ?>
            </table>
        </div>
</body>
</html>