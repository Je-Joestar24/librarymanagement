<?php
include 'DBconnect.php';

// Check if form is submitted if ambot
    $book_id = $_POST['book_id'];
    $title = $_POST['Edittitle'];
    $year = $_POST['Edityear'];
    $no_copies = $_POST['Editno_copies'];
    $no_cd_copy = $_POST['Editno_cd_copy'];
    $authors = $_POST['Editauthors'];
    $categories = $_POST['Editcategories'];
    $accounts = $_POST['Editaccounts'];
    
    // Update book table
    if($title != null){
    $update_book_query = "UPDATE book SET title='$title', year='$year', no_copies='$no_copies', no_cd_copy='$no_cd_copy' WHERE book_id='$book_id'";
    mysqli_query($connect, $update_book_query);
    
    // Remove all existing book_authors for the book
    $remove_authors_query = "DELETE FROM book_authors WHERE book_id='$book_id'";
    mysqli_query($connect, $remove_authors_query);
    
    // Insert new book_authors for the book
    $authors_array = explode(',', $authors);
    foreach($authors_array as $author) {
        $author = trim($author);
        $author_id_query = "SELECT author_id FROM author WHERE name='$author'";
        $author_id_result = mysqli_query($connect, $author_id_query);
        if(mysqli_num_rows($author_id_result) == 1) {
            $row = mysqli_fetch_assoc($author_id_result);
            $author_id = $row['author_id'];
        } else {
            $add_author_query = "INSERT INTO author (name) VALUES ('$author')";
            mysqli_query($connect, $add_author_query);
            $author_id = mysqli_insert_id($connect);
        }
        $add_book_author_query = "INSERT INTO book_authors (book_id, author_id) VALUES ('$book_id', '$author_id')";
        mysqli_query($connect, $add_book_author_query);
    }
    
    // Remove all existing book_category for the book
    $remove_categories_query = "DELETE FROM book_category WHERE book_id='$book_id'";
    mysqli_query($connect, $remove_categories_query);
    
    // Insert new book_category for the book
    $categories_array = explode(',', $categories);
    foreach($categories_array as $category) {
        $category = trim($category);
        $category_id_query = "SELECT category_id FROM category WHERE category_name='$category'";
        $category_id_result = mysqli_query($connect, $category_id_query);
        if(mysqli_num_rows($category_id_result) == 1) {
            $row = mysqli_fetch_assoc($category_id_result);
            $category_id = $row['category_id'];
        } else {
            $add_category_query = "INSERT INTO category (category_name) VALUES ('$category')";
            mysqli_query($connect, $add_category_query);
            $category_id = mysqli_insert_id($connect);
        }
        $add_book_category_query = "INSERT INTO book_category (book_id, category_id) VALUES ('$book_id', '$category_id')";
        mysqli_query($connect, $add_book_category_query);
    }
    
    // Remove all existing book_accounts for the book
    $remove_accounts_query = "DELETE FROM book_accounts WHERE book_id='$book_id'";
    mysqli_query($connect, $remove_accounts_query);
    
    // Insert new book_accounts for the book
    $accounts_array = explode(',', $accounts);
    foreach($accounts_array as $account) {
        $account = trim($account);
        $account_id_query = "SELECT account_id FROM accounts WHERE account_no='$account'";
        $account_id_result = mysqli_query($connect, $account_id_query);
        if(mysqli_num_rows($account_id_result) == 1) {
        $row = mysqli_fetch_assoc($account_id_result);
        $account_id = $row['account_id'];
        } else {
        $add_account_query = "INSERT INTO accounts (account_no) VALUES ('$account')";
        mysqli_query($connect, $add_account_query);
        $account_id = mysqli_insert_id($connect);
        }
        $add_book_account_query = "INSERT INTO book_accounts (book_id, account_id) VALUES ('$book_id', '$account_id')";
        mysqli_query($connect, $add_book_account_query);
        }
    } else{
        echo "empty";
    }
?>
