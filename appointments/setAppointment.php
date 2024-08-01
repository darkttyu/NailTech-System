<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/icon type"> <!-- Favicon for the page -->
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet"> <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome icons -->
    <link rel="stylesheet" href="../assets/setAppointmentStyle.css"> <!-- Custom CSS for styling -->
    <title>Set Appointment</title> <!-- Page title -->
</head>
<body>
    <!-- Navigation bar -->
    <div class="topnav">
        <img id="logo" src="/assets/logo.png" alt="Logo"> <!-- Logo image -->
        <a id="home" href="/homepage.html"> HOME </a> <!-- Home link -->
        <a id="employee" href="/employeePage.php"> EMPLOYEE MANAGEMENT</a> <!-- Employee management link -->
        <a id="appointment" href="/appointmentPage.php"> APPOINTMENT SCHEDULING </a> <!-- Appointment scheduling link -->
    </div>
    
    <p id="instruction">Provide the following details to Set an Appointment.</p> <!-- Instructions -->

    <div class="setAppointmentContainer">
        <!-- Appointment form -->
        <form action="insertAppointment.php" method="POST">
            <p id="customerName">Customer Name:</p>
            <input id="customerNameInput" type="text" placeholder="E.g Juan Dela Cruz" name="customerName" required>

            <p id="phoneNumber">Phone Number:</p>
            <input id="customerNumberInput" type="text" placeholder="E.g 09xx xxx xxxx" name="customerNumber" required>

            <p id="date">Date:</p>
            <input id="dateInput" type="date" name="appointmentDate" required>

            <p id="time">Time:</p>
            <input id="timeInput" type="time" name="appointmentTime" required>
            
            <!-- Include PHP script to retrieve and display employee names -->
            <?php include 'retrieveEmployeeName.php'; ?>
            <p id="nailTechName">Assigned Nail Technician:</p>
            <select id="selectTech" name="nailTechAssigned" required>
                <option value="">Select Nail Technician</option>
                <!-- Populate options with employee IDs from PHP -->
                <?php foreach($employees as $employee): ?>    
                    <option value="<?php echo htmlspecialchars($employee['empID']); ?>">
                        <?php echo htmlspecialchars($employee['empID']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input id="confirmButton" type="submit" value="CONFIRM APPOINTMENT" onclick="return confirmAppointment()" required>
        </form>

        <!-- Button to return to the appointment page -->
        <input id="returnButton" type="button" value="RETURN TO APPOINTMENT PAGE" onclick="return toAppointmentPage()">
    </div>

    <!-- JavaScript functions -->
    <script>
        // Function to display a confirmation dialog before form submission
        function confirmAppointment() {
            let dialog = "Confirm Appointment Scheduled?\nCheck if all necessary information is present or Cancel.";
            return window.confirm(dialog);
        }

        // Function to navigate back to the appointment page
        function toAppointmentPage() {
            window.location.href = '../appointmentPage.php';
        }
    </script>
</body>
</html>
