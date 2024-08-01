<?php 

// Checks if the request method is a POST request
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Set'])) {
        // If the 'Add' button is clicked, redirect to the employee add page
        header("Location: appointments/setAppointment.php");
        // Stop further execution
        exit();
    } else if (isset($_POST['Update'])) {
        // If the 'Update' button is clicked, redirect to the employee update page
        header("Location: appointments/updateAppointment.php");
        // Stop further execution
        exit();
    } else if (isset($_POST['Cancel'])) {
        echo "<script>
            var customerName = window.prompt('To cancel an Appointment, search for the name of the Customer First: ');
        
            if (customerName) {
                var confirmDialog = window.confirm('Confirm Appointment Cancellation?\\nCheck if all necessary information is present or Cancel.');
                
                if (confirmDialog) {
                    window.location.href='/appointments/cancelAppointment.php?customerName=' + encodeURIComponent(customerName);
                } else {
                    alert('Cancellation Aborted.');
                    window.location.href = '../appointmentPage.php'
                }
            } else {
                window.alert('Cancellation Aborted. No customer name found.');
                window.location.href = '../appointmentPage.php';
            }
            </script>";
            exit();
        }
}

?>
