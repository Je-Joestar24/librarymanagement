<?php
include 'DBconnect.php';

$searched = $_GET['search'];

$sql = "SELECT b.book_id, b.title, b.year, GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') 
    AS authors, GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') 
    AS categories, GROUP_CONCAT(DISTINCT ac.account_no SEPARATOR ', ') 
    AS accountss, b.no_copies, b.no_cd_copy FROM book b LEFT JOIN 
    book_category bc on bc.book_id = b.book_id LEFT JOIN category c 
    on c.category_id = bc.category_id LEFT JOIN book_authors ba on b.book_id = ba.book_id 
    LEFT JOIN author a on a.author_id = ba.author_id LEFT JOIN book_accounts 
    bAc on bAc.book_id = b.book_id LEFT JOIN accounts ac on ac.account_id = bAc.account_id 
    where b.no_copies >= 1 && (b.title like '%$searched%' || b.book_id like '%$searched%' ||  c.category_name like '%$searched%' ||    ac.account_no like '%$searched%' || a.name like '%$searched%')
    GROUP BY b.book_id";
$result = mysqli_query($connect, $sql);
$counter = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if ($counter % 2 == 0) {
        echo '<div class="row">';
    }
?>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2 text-dark d-flex pt-4 justify-content-center">
                    <i class="fas fa-book fa-4x"></i>
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title'] ?></h5>
                        <p class="card-text"><strong>Author:</strong> <?php echo $row['authors'] ?></p>
                        <p class="card-text"><strong>Category:</strong> <?php echo $row['categories'] ?></p>
                        <p class="card-text"><strong>Year:</strong> <?php echo $row['year'] ?></p>
                        <p class="card-text"><strong>Accounts:</strong> <?php echo $row['accountss'] ?></p>
                        <p class="card-text"><strong>Available Copies:</strong> <?php echo $row['no_copies'] ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button id="requestBtn" class="requestBtn btn btn-sm btn-primary me-2" onclick="sendBookers(<?php echo $row['book_id'] ?>)">
                    <i class="fas fa-hand-holding-heart me-1"></i> Request
                </button>
            </div>
        </div>
    </div>

<?php
    $counter++;
    if ($counter % 2 == 0) {
        echo '</div>';
    }
}
// If the number of columns is odd, close the row div
if ($counter % 2 != 0) {
    echo '</div>';
}
?>