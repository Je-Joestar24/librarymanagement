<?php
include 'DBconnect.php';

$selectedMonth = $_GET['month'];
$selectedYear = $_GET['year'];
$selectedAuthor = $_GET['author'];
$selectedCategory = $_GET['category'];
$selectedStatus = $_GET['status'];
$searched = $_GET['search'];
$status = "";
$category = "";
$Author = "";

if($selectedCategory != 0) $category = "cat.category_id = '$selectedCategory' AND ";
if($selectedAuthor != 0) $Author = "au.author_id = '$selectedAuthor' AND ";
if($selectedStatus == 1) $status = "br.return_date is not null &&";
else if($selectedStatus == 2) $status = "br.return_date is null &&";

$sql = "SELECT current_date() as cur, b.book_id, br.borrowing_id, b.title, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b 
INNER JOIN borrowings br ON br.book_id = b.book_id
INNER JOIN users u ON br.user_id = u.user_id
INNER JOIN user_course uc ON uc.user_id = u.user_id
INNER JOIN courses c ON c.course_id = uc.course_id
LEFT JOIN book_authors  ba ON b.book_id = ba.book_id
LEFT JOIN author au on ba.author_id = au.author_id
LEFT JOIN book_category bc on b.book_id = bc.book_id
LEFT JOIn category cat on bc.category_id = cat.category_id
Where ".$status."  MONTH(br.checkout_date) = '$selectedMonth' AND YEAR(br.checkout_date) = '$selectedYear' AND ".$category.$Author."
(br.borrowing_id like '%$searched%' or Concat(u.first_name, ' ', u.last_name) like '%$searched%' or concat(c.course_name, ' ', u.year) like '%$searched%' or b.title like '%$searched%')
GROUP BY br.borrowing_id;";

$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>">
        <td><?php echo $row['borrowing_id'] ?></td>
        <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
        <td><?php echo $row['course_name'] . " " . $row['year'] ?></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo $row['checkout_date'] ?></td>
        <td><?php echo $row['duedate'] ?></td>
        <td class="text-center"><?php if ($row['return_date'] ==  null) echo "<div class = ' rounded-5 bg-warning'>Not returned</div>";
            else echo "<div class = 'bg-primary rounded-5'>returned</div>"; ?></td>
        <td class="text-center"><?php if ($row['return_date'] >  $row['duedate'] || $row['duedate'] < $row['cur']) echo "<div class = 'bg-danger rounded-5'>Overdued</div>";else echo "<div class = 'bg-success rounded-5'>Under due</div>"; ?></td>
    </tr>
<?php }
?>