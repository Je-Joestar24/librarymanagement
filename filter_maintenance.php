<?php
include 'DBconnect.php';

$selectedYear = $_GET['year'];
$searched = $_GET['search'];
$authId = $_GET['author'];
$catId = $_GET['category'];
$status = $_GET['status'];
$condition = "(b.year = '$selectedYear') and ";
$cond = "";
if($selectedYear == "") $condition = "";
if($status == 1) $cond = "b.no_copies != 0 and ";
else if($status == 2) $cond = "b.no_copies = 0 and ";


$sql = "SELECT b.book_id, b.title, b.year, GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') 
    AS authors, GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') 
    AS categories, GROUP_CONCAT(DISTINCT ac.account_no SEPARATOR ', ') 
    AS accountss, b.no_copies, b.no_cd_copy FROM book b LEFT JOIN 
    book_category bc on bc.book_id = b.book_id LEFT JOIN category c 
    on c.category_id = bc.category_id LEFT JOIN book_authors ba on b.book_id = ba.book_id 
    LEFT JOIN author a on a.author_id = ba.author_id LEFT JOIN book_accounts 
    bAc on bAc.book_id = b.book_id LEFT JOIN accounts ac on ac.account_id = bAc.account_id 
    where ".$condition.$cond." (a.author_id like '%$authId%' || a.author_id is null) and (c.category_id like '%$catId%' || c.category_id is null) and(b.title like '%$searched%' || b.book_id like '%$searched%' ||  c.category_name like '%$searched%' ||    ac.account_no like '%$searched%' || a.name like '%$searched%')
    GROUP BY b.book_id";
$result = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($result)) {
?><tr  class="clickable-row1" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"  >
        <td style="width: 5%"><?php echo $row['book_id'] ?></td>
        <td style="width: 25%"><?php echo $row['title'] ?></td>
        <td style="width: 15%"><?php echo $row['authors'] ?></td>
        <td style="width: 20%"><?php echo $row['categories'] ?></td>
        <td style="width: 10%"><?php echo $row['year'] ?></td>
        <td style="width: 15%"><?php echo $row['accountss'] ?></td>
        <td style="width: 10%" class="text-center"><?php if($row['no_copies'] <= 0) echo "<div class = 'text-white bg-danger rounded-5'>Not Available</div>";
        else echo "<div class = 'text-white bg-success rounded-5'>Available</div>" ?></td>
    </tr>
<?php }
?>