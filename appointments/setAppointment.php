<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/setAppointmentStyle.css">
    <title>Employee Management</title>
</head>
<body>
        <div class="topnav">
            <img id="logo" src="/assets/logo.png"> 
            <a id="home" href="/homepage.html"> HOME </a>
            <a id="employee" href="/employeePage.php"> EMPLOYEE MANAGEMENT</a>
            <a id="appointment" href="/appointmentPage.php"> APPOINTMENT SCHEDULING </a>
        </div>
        
        <p id="instruction">Provide the following details to Set an Appointment.</p>

        <div class="setAppointmentContainer">
            <form action="insertAppointment.php" method="POST">
                <p id="customerName">Customer Name:</p>
                <input id="customerNameInput" type="text" placeholder="E.g Juan Dela Cruz" name="customerName" required>

                <p id="phoneNumber">Phone Number:</p>
                <input id="customerNumberInput" type="text" placeholder="E.g 09xx xxx xxxx" name="customerNumber" required>

                <p id="date">Date:</p>
                <input id="dateInput" type="date" name="appointmentDate" required>

                <p id="time">Time:</p>
                <input id="timeInput" type="time" name="appointmentTime" required>
                
                <?php include 'retrieveEmployeeName.php' ?>
                <p id="nailTechName">Assigned Nail Technician:</p>
                    <select id="selectTech" name="nailTechAssigned" required>
                        <option value="">Select Nail Technician</option>
                        <?php foreach($employees as $employee): ?>    
                            <option value="<?php echo htmlspecialchars($employee['empID']); ?>"> <?php echo htmlspecialchars($employee['empID']); ?></option>
                        <?php endforeach; ?>
                    </select>

                <input id=confirmButton type="submit" value="CONFIRM APPOINTMENT" onclick="return confirmAppointment()" required>
            </form>

                <input id=returnButton type="button" value="RETURN TO APPOINTMENT PAGE" onclick="return toAppointmentPage()">
        </div>

        <!-- JavaScript function to confirm form submission -->
        <script>
            function confirmAppointment() {
                let dialog = "Confirm Appointment Scheduled?\nCheck if all necessary information are present or Cancel.";
                return window.confirm(dialog);
            }

            function toAppointmentPage() {
                window.location.href='../appointmentPage.php';
            }
        </script>
</body>
</html>