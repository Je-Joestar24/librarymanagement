<?php
// Include DB connection
require_once 'DBconnect.php';

// Fetch courses from the database
$query = "SELECT * FROM courses";
$result = $connect->query($query);

if ($result) {
    $courses = array();

    while ($row = $result->fetch_assoc()) {
        $course = array(
            'course_id' => $row['course_id'],
            'course_name' => $row['course_name']
        );

        $courses[] = $course;
    }

    // Return the courses as a JSON response
    echo json_encode(array('status' => 'success', 'data' => $courses));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Failed to fetch courses.'));
}

// Close the database connection
$connect->close();
?>
