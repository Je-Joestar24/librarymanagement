<?php
// update_borrow_request.php
include 'DBconnect.php';
// Assuming you have already included the necessary database connection file

    // Retrieve the data sent via AJAX
    $reqId = $_POST['reqId'];
    $added = $_POST['added'];

    // Update the borrow_request table
    $query = "UPDATE borrow_request SET added = '$added' WHERE req_id = '$reqId'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        // Success message
        echo "Borrow request updated successfully";
    } else {
        // Error message
        echo "Failed to update borrow request";
    }

?>
