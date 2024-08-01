<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/updateAppointmentStyle.css">
    <title>Update Appointment</title>
</head>
<body>
    <div class="topnav">
        <img id="logo" src="/assets/logo.png">
        <a id="home" href="/homepage.html"> HOME </a>
        <a id="employee" href="/employeePage.php"> EMPLOYEE MANAGEMENT</a>
        <a id="appointment" href="/appointmentPage.php"> APPOINTMENT SCHEDULING </a>
    </div>

    <div class='searchContainer'>
        <form action="updateAppointment.php" method="GET">
            <input id="searchAppointment" name="searchedName" type="search" placeholder="Search Appointment..">
            <button type="submit" id="searchIcon"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <?php include 'searchAppointment.php'; ?>

    <div class="appointmentUpdateContainer">
        <form action='updateAppointmentInformation.php' method='POST'>
            <div class="appointmentInformation">
                <p id="name">Customer Name:</p>
                <input id="customerNameInput" 
                type="text"
                name="customerName"  
                value="<?php echo htmlspecialchars($appointment['customerName'] ?? '')?>" 
                required>

                <p id="number">Phone Number:</p>
                <input id="customerNumberInput" 
                type="text"
                name="customerNumber" 
                value="<?php echo htmlspecialchars($appointment['customerPhone'] ?? '')?>"
                required>

                <p id="date">Date:</p>
                <input id="dateInput" 
                type="date" 
                name="appointmentDate"
                value="<?php echo htmlspecialchars($appointment['date'])?>"
                required>

                <p id="time">Time:</p>
                <input id="timeInput" 
                type="time"
                name="appointmentTime"
                value="<?php echo htmlspecialchars($appointment['time'])?>" 
                required>
                
                <?php include 'retrieveEmployeeName.php' ?>
                    <p id="nailTechName">Assigned Nail Technician:</p>
                        <select id="selectTech" name="nailTechAssigned" required>
                                <option value="">Select Nail Technician</option>
                            <?php foreach($employees as $employee): ?>    
                                <option <?php echo (isset($appointment['empID']) && $appointment['empID'] == $employee['empID']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($employee['empID']); ?>
                                </option>
                                
                            <?php endforeach; ?>
                        </select>
                
                <p id="appointmentStatus">Appointment Status</p>
                <select id="selectStatus" name="appointmentStatus">
                    <option value="">Select Appointment Status</option>
                    <option value="Scheduled" 
                    <?php echo (isset($appointment['appointmentStatus']) && $appointment['appointmentStatus'] == 'Scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                    <option value="Rescheduled"
                    <?php echo (isset($appointment['appointmentStatus']) && $appointment['appointmentStatus'] == 'Rescheduled') ? 'selected' : ''; ?>>Rescheduled</option>
                    <option value="On going"
                    <?php echo (isset($appointment['appointmentStatus']) && $appointment['appointmentStatus'] == 'On going') ? 'selected' : ''; ?>>On going</option>
                    <option value="Completed"
                    <?php echo (isset($appointment['appointmentStatus']) && $appointment['appointmentStatus'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>

                <input id="confirmButton" type="submit" value="CONFIRM APPOINTMENT UPDATE" onclick="return confirmAppointmentUpdate()">
            </div>
        </form>
        
        <input id="returnButton" type="button" value="RETURN TO APPOINTMENT PAGE" onclick="return toAppointmentPage()"> 
    </div>

    <script>
        function confirmAppointmentUpdate() {
            let dialog = "Confirm Appointment Update?\nCheck if all necessary information are present or Cancel.";
            return window.confirm(dialog);
        }

        function toAppointmentPage() {
            window.location.href='../appointmentPage.php';
        }
    </script>
</body>
</html>
