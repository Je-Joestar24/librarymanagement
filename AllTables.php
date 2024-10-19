<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
</head>

<body class="bg-success rounded">
    <div class=" d-flex text-center gap-2">
        <form action="AllTables.php" method="post" style="display: inline;">
            <input hidden type="text" name="Query" value="SELECT b.book_id, b.title, b.year, GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') AS authors, GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') AS categories, GROUP_CONCAT(DISTINCT ac.account_no SEPARATOR ', ') AS accounts, b.no_copies, b.no_cd_copy 
                    FROM book b LEFT JOIN book_category bc on bc.book_id = b.book_id LEFT JOIN category c on c.category_id = bc.category_id LEFT JOIN book_authors ba on b.book_id = ba.book_id LEFT JOIN author a on a.author_id = ba.author_id LEFT JOIN book_accounts bAc on bAc.book_id = b.book_id LEFT JOIN accounts ac on ac.account_id = bAc.account_id GROUP BY b.book_id">
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input hidden type="text" name="Show" value="book_id, title, year, authors, categories, accounts, no_copies, no_cd_copy">
            <input hidden type="text" name="heads" value="Book ID, Title, Year, Authors, Categories, Account Numbers, No. of Copies, No. CD copies">
            <input type="submit" value="BOOKS" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT * FROM author" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">

            <input type="text" name="Show" value="author_id, name" hidden>
            <input type="text" name="heads" value="AUTHOR ID, NAME" hidden>
            <input type="submit" value="AUTHORS" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT * FROM category" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">

            <input type="text" name="Show" value="category_id, category_name" hidden>
            <input type="text" name="heads" value="Category ID, Category" hidden>
            <input type="submit" value="CATEGORIES" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT * FROM accounts" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input type="text" name="Show" value="account_id, account_no" hidden>
            <input type="text" name="heads" value="Account ID, Account Number" hidden>
            <input type="submit" value="ACCOUNT NUMBERS" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT users.first_name, users.last_name,  users.user_id, CONCAT(users.first_name, ' ', users.last_name) AS user_name, users.password, users.username, users.email, CONCAT(users.year ,' - ', courses.course_name) as Course_year, users.year, courses.course_name, courses.course_id      FROM users JOIN user_course ON users.user_id = user_course.user_id JOIN courses ON user_course.course_id = courses.course_id" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">

            <input type="text" name="Show" value="user_id, user_name, Course_year, email, password" hidden>
            <input type="text" name="heads" value="ID, Name, Course, Email, Password" hidden>
            <input type="submit" value="USERS" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT b.book_id, br.borrowing_id, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, CONCAT(u.first_name, ' ', u.last_name) as user_name, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, CONCAT(c.course_name, ' ', u.year) as course_year, c.course_name, u.year, u.user_id FROM book b  INNER JOIN borrowings br ON br.book_id = b.book_id INNER JOIN users u ON br.user_id = u.user_id INNER JOIN user_course uc ON uc.user_id = u.user_id INNER JOIN courses c ON c.course_id = uc.course_id GROUP BY br.borrowing_id order by br.checkout_date desc;" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input type="text" name="Show" value="borrowing_id, books, checkout_date, duedate, return_date, user_name, course_year" hidden>
            <input type="text" name="heads" value="Borrowing_id, Borrowed books, Borrowed_Date, Due date, Return Date, USERNAME, COURSE YEAR" hidden>
            <input type="submit" value="BORROWERS" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT current_date() as cur, b.book_id, br.borrowing_id, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, CONCAT(u.first_name, ' ', u.last_name) as user_name, CONCAT(c.course_name, ' ', u.year) as course_year, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b  INNER JOIN borrowings br ON br.book_id = b.book_id INNER JOIN users u ON br.user_id = u.user_id INNER JOIN user_course uc ON uc.user_id = u.user_id INNER JOIN courses c ON c.course_id = uc.course_id WHERE br.return_date is not NULL GROUP BY br.borrowing_id;" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input type="text" name="Show" value="borrowing_id, books, checkout_date, duedate, return_date, user_name, course_year" hidden>
            <input type="text" name="heads" value="Borrowing_id, Borrowed books, Borrowed_Date, Due date, Return Date, USERNAME, COURSE YEAR" hidden>
            <input type="submit" value="RETURNED" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT current_date() as cur, b.book_id, br.borrowing_id, CONCAT(u.first_name, ' ', u.last_name) as user_name, CONCAT(c.course_name, ' ', u.year) as course_year, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b  INNER JOIN borrowings br ON br.book_id = b.book_id INNER JOIN users u ON br.user_id = u.user_id INNER JOIN user_course uc ON uc.user_id = u.user_id INNER JOIN courses c ON c.course_id = uc.course_id WHERE br.return_date IS NULL GROUP BY br.borrowing_id;" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input type="text" name="Show" value="borrowing_id, books, checkout_date, duedate, return_date, user_name, course_year" hidden>
            <input type="text" name="heads" value="Borrowing_id, Borrowed books, Borrowed_Date, Due date, Return Date, USERNAME, COURSE YEAR" hidden>
            <input type="submit" value="NOT RETURNED" name="Table" class="btn btn-dark my-2">
        </form>
        <form action="AllTables.php" method="post" style="display: inline;">
            <input type="text" name="Query" value="SELECT b.book_id, br.borrowing_id, CONCAT(u.first_name, ' ', u.last_name) as user_name, CONCAT(c.course_name, ' ', u.year) as course_year, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b  INNER JOIN borrowings br ON br.book_id = b.book_id INNER JOIN users u ON br.user_id = u.user_id INNER JOIN user_course uc ON uc.user_id = u.user_id INNER JOIN courses c ON c.course_id = uc.course_id WHERE br.duedate < br.return_date || (br.duedate < now() && br.return_date is null)  GROUP BY br.borrowing_id;" hidden>
            <input hidden type="text" name="classes" value="table table-hover bg-light border-0 rounded-3 table-sm">
            <input type="text" name="Show" value="borrowing_id, books, checkout_date, duedate, return_date, user_name, course_year" hidden>
            <input type="text" name="heads" value="Borrowing_id, Borrowed books, Borrowed_Date, Due date, Return Date, USERNAME, COURSE YEAR" hidden>
            <input type="submit" value="OVERDUED" name="Table" class="btn btn-dark my-2">
        </form>
    </div>

    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn m-3 btn-primary" data-bs-toggle="modal" data-bs-target="#ModalBase">
            Add New
        </button>
        <?php
        include('Methods/Tables.php');

        if (isset($_POST['Table'])) {
            tablize(explode(", ", $_POST['heads']), $_POST['Query'], $_POST['classes'], "DBconnect.php", $_POST['Show']);
            modalCreation(explode(", ", $_POST['Show']), "ModalBase", explode(', ', $_POST['heads']), "Form");
        }
        ?>
    </div>

    <script src="BOOTSTRAP/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php 

    if(isset($_POST['sbmt']) && $_POST['sbmt'] == "Save"){
        $frmData = array();
        foreach($_POST as $k => $v) if($k != 'sbmt')array_push($frmData,$v);
//      foreach(array_values($frmData) as $frm) echo "<br>". $frm;
    }

?>