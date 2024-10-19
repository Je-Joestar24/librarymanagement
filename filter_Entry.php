<?php
include 'DBconnect.php';

$selectedMonth = $_GET['month'];
$selectedYear = $_GET['year'];
$searched = $_GET['search'];

$sql = "SELECT c.course_name, u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS username, u.email, u.user_id, u.last_name, u.first_name, CONCAT(c.course_name, ' - ', u.year) AS course_year, u.year, DATE_FORMAT(a.login_time, '%b %d, %Y') AS login_date, DATE_FORMAT(a.login_time, '%h:%i %p') AS login_time 
        FROM users u
        INNER JOIN user_course uc ON u.user_id = uc.user_id
        INNER JOIN courses c ON uc.course_id = c.course_id
        INNER JOIN attendance a ON u.user_id = a.user_id
        WHERE MONTH(a.login_time) = '$selectedMonth' AND YEAR(a.login_time) = '$selectedYear'AND
        (Concat(u.first_name, ' ', u.last_name) like '%$searched%' || Concat(c.course_name, ' - ', u.year) like '%$searched%' || DATE_FORMAT(a.login_time, '%h:%i %p') like '%$searched%' || DATE_FORMAT(a.login_time, '%b %d, %Y') like '%$searched%') order by login_date, login_time ";

$result = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>">
        <td><?php echo $row['login_date'] ?></td>
        <td><?php echo $row['login_time'] ?></td>
        <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
        <td><?php echo $row['course_name'] . " - " . $row['year'] ?></td>
    </tr>
<?php }
?>
