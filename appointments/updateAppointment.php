<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/icon type"> <!-- Favicon for the page -->
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet"> <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome icons -->
    <link rel="stylesheet" href="../assets/updateAppointmentStyle.css"> <!-- Custom CSS for styling -->
    <title>Update Appointment</title> <!-- Page title -->
</head>
<body>
    <!-- Navigation bar -->
    <div class="topnav">
        <img id="logo" src="/assets/logo.png" alt="Logo"> <!-- Logo image -->
        <a id="home" href="/homepage.html"> HOME </a> <!-- Home link -->
        <a id="employee" href="/employeePage.php"> EMPLOYEE MANAGEMENT</a> <!-- Employee management link -->
        <a id="appointment" href="/appointmentPage.php"> APPOINTMENT SCHEDULING </a> <!-- Appointment scheduling link -->
    </div>

    <!-- Search form for appointment -->
    <div class='searchContainer'>
        <form action="updateAppointment.php" method="GET">
            <input id="searchAppointment" name="searchedName" type="search" placeholder="Search Appointment.."> <!-- Search input -->
            <button type="submit" id="searchIcon"><i class="fas fa-search"></i></button> <!-- Search button with icon -->
        </form>
    </div>

    <!-- Include PHP script for handling search results -->
    <?php include 'searchAppointment.php'; ?>

    <!-- Form to update appointment information -->
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
                
                <!-- Include PHP script to retrieve employee names -->
                <?php include 'retrieveEmployeeName.php'; ?>
                <p id="nailTechName">Assigned Nail Technician:</p>
                <select id="selectTech" name="nailTechAssigned" required>
                    <option value="">Select Nail Technician</option>
                    <!-- Populate options with employee IDs from PHP -->
                    <?php foreach($employees as $employee): ?>    
                        <option <?php echo (isset($appointment['empID']) && $appointment['empID'] == $employee['empID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($employee['empID']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <p id="appointmentStatus">Appointment Status:</p>
                <select id="selectStatus" name="appointmentStatus">
                    <option value="">Select Appointment Status</option>
                    <!-- Populate status options based on current status -->
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
        
        <!-- Button to return to the appointment page -->
        <input id="returnButton" type="button" value="RETURN TO APPOINTMENT PAGE" onclick="return toAppointmentPage()"> 
    </div>

    <!-- JavaScript functions -->
    <script>
        // Function to display a confirmation dialog before form submission
        function confirmAppointmentUpdate() {
            let dialog = "Confirm Appointment Update?\nCheck if all necessary information is present or Cancel.";
            return window.confirm(dialog);
        }

        // Function to navigate back to the appointment page
        function toAppointmentPage() {
            window.location.href = '../appointmentPage.php';
        }
    </script>
</body>
</html>
