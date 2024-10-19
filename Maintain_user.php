<?php
include 'DBconnect.php';

$selectedcourse = $_GET['course'];
$selectedYear = $_GET['year'];
$searched = $_GET['search'];

$year = "";
$course = "";
if($selectedYear != null) $year = "users.year = '$selectedYear' && ";
if($selectedcourse != 0) $course = "courses.course_id = '$selectedcourse' && ";

$sql = "SELECT users.first_name, users.last_name,  users.user_id, CONCAT(users.first_name, ' ', users.last_name) AS username, users.email, users.year, courses.course_name, courses.course_id FROM users
JOIN user_course ON users.user_id = user_course.user_id
JOIN courses ON user_course.course_id = courses.course_id where ".$year.$course."  (users.user_id like '%$searched%' || concat(users.first_name, ' ', users.last_name ) like '%$searched%' || users.email like '%$searched%' || concat(courses.course_name, ' - ', users.year) like '%$searched%' )";

$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" >
        <td class="text-center"><?php echo $row['user_id'] ?></td>
        <td><?php echo $row['username'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td class="text-center"><?php echo $row['course_name'] . " - " . $row['year']  ?></td>
    </tr>
<?php }
?>