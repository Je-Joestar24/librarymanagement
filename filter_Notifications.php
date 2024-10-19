<?php
include 'DBconnect.php';

$selectedMonth = $_GET['month'];
$selectedYear = $_GET['year'];
$selectedStatus = $_GET['status'];
$searched = $_GET['search'];
$status = "";

if($selectedStatus == 0) $status = "nt.notification_type = 0 &&";
else if($selectedStatus == 1) $status = "nt.notification_type = 1 &&";

$sql = "SELECT u.first_name, u.last_name, c.course_name, u.year, u.email, b.title, DATE_FORMAT(nt.created_at, '%h:%i %p') AS formatted_time, DATE_format(nt.created_at, '%m - %d - %y') AS formatted_date,  nt.notification_type FROM users u 
INNER JOIN notifications nt on nt.user_id = u.user_id
INNER JOIN book b on b.book_id = nt.book_id
INNER JOIN user_course uc on uc.user_id
INNER JOIN courses c on c.course_id = uc.course_id
Where ".$status." MONTH(nt.created_at) = '$selectedMonth' AND YEAR(nt.created_at) = '$selectedYear' AND
(nt.notification_id like '%$searched%' or Concat(u.first_name, ' ', u.last_name) like '%$searched%' or b.title like '%$searched%')
GROUP BY nt.notification_id ORDER BY nt.created_at desc";

$result = mysqli_query($connect, $sql);
$cnt = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $cnt ?></td>
        <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
        <td><?php echo $row['course_name'] . " " . $row['year'] ?></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo $row['formatted_date'] ?></td>
        <td class=" text-center"><?php if($row['notification_type'] == 0) echo "<div class = 'rounded-5 bg-warning'>Not returned</div>";
            else echo "<div class = 'bg-primary rounded-5'>returned</div>"; ?></td>
    </tr>
<?php $cnt ++;}
?>