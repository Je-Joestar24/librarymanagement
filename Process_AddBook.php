<?php

include 'DBconnect.php';

// Get form data
$title = mysqli_real_escape_string($connect, $_POST['title']);
$categories = explode(',', mysqli_real_escape_string($connect, $_POST['categories']));
$year = mysqli_real_escape_string($connect, $_POST['year']);
$authors = explode(',', mysqli_real_escape_string($connect, $_POST['authors']));
$accounts = explode(',', mysqli_real_escape_string($connect, $_POST['accounts']));
$copies = mysqli_real_escape_string($connect, $_POST['copies']);
$cd_copies = mysqli_real_escape_string($connect, $_POST['cd_copies']);

// Check if book already exists
$query = "SELECT book_id FROM book WHERE title='$title' AND year='$year'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) == 0) {
    

    // Book doesn't exist, insert it into book table
    $query = "INSERT INTO book (title, year, no_copies, no_cd_copy) VALUES ('$title', '$year', '$copies', '$cd_copies')";
    mysqli_query($connect, $query);
    $book_id = mysqli_insert_id($connect);


// Insert categories into category table and book_category table
foreach ($categories as $category) {
    $category = trim($category);
    if ($category != '') {
        // Check if category already exists
        $query = "SELECT category_id FROM category WHERE category_name='$category'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            // Category already exists, get its ID
            $row = mysqli_fetch_assoc($result);
            $category_id = $row['category_id'];
        } else {
            // Category doesn't exist, insert it into category table
            $query = "INSERT INTO category (category_name) VALUES ('$category')";
            mysqli_query($connect, $query);
            $category_id = mysqli_insert_id($connect);
        }
        // Insert category into book_category table
        $query = "INSERT INTO book_category (book_id, category_id) VALUES ('$book_id', '$category_id')";
        mysqli_query($connect, $query);
    }
}

// Insert authors into author table and book_authors table
foreach ($authors as $author) {
    $author = trim($author);
    if ($author != '') {
        // Check if author already exists
        $query = "SELECT author_id FROM author WHERE name='$author'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            // Author already exists, get its ID
            $row = mysqli_fetch_assoc($result);
            $author_id = $row['author_id'];
        } else {
            // Author doesn't exist, insert it into author table
            $query = "INSERT INTO author (name) VALUES ('$author')";
            mysqli_query($connect, $query);
            $author_id = mysqli_insert_id($connect);
        }
        // Insert author into book_authors table
        $query = "INSERT INTO book_authors (book_id, author_id) VALUES ('$book_id', '$author_id')";
        mysqli_query($connect, $query);
    }
}

// Insert accounts into accounts table and book_accounts table
foreach ($accounts as $account) {
    $account = trim($account);
    if ($account != '') {
        // Check if account already exists
        $query = "SELECT account_id FROM accounts WHERE account_no='$account'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            // Account already exists, get its ID
            $row = mysqli_fetch_assoc($result);
            $account_id = $row['account_id'];
        } else {
            // Account doesn't exist, insert it into accounts table
            $query = "INSERT INTO accounts (account_no) VALUES ('$account')";
            mysqli_query($connect, $query);
            $account_id = mysqli_insert_id($connect);
        }
        // Insert account into book_accounts table
        $query = "INSERT INTO book_accounts (book_id, account_id) VALUES ('$book_id', '$account_id')";
        mysqli_query($connect, $query);
    }
}
} else {
    echo "exists";
}

?>