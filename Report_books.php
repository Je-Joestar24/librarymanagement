<?php
session_start(); // Make sure to start the session
include('DBconnect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$librarianID = $_SESSION['user_id'];

$row = mysqli_fetch_assoc(mysqli_query($connect, "Select * from librarians where librarian_id = '$librarianID'"));
?>

<!DOCTYPE html>
<html>

<head>

    <title>Report books</title>
    <link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="Font/css/all.css">
    <link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/bootstrap.min.js"></script>
    <script src="JS/popper.min.js"></script>
    <link rel="stylesheet" href="Design/datatables.css">

    <script src="DataTables/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/dataTables.bootrap5.min.css">

    <!-- Add the DataTables plugin script and its dependencies -->
    <script defer src="DataTables/jquery.dataTables.min.js"></script>
    <script defer src="DataTables/dataTables.bootstrap5.min.js"></script>


    <link rel="stylesheet" href="Design/datatables.css">
    <link rel="stylesheet" href="Design/side.css">
    <!-- Include the DataTables CSS file -->
</head>

<body>

    <?php include "sidebar.php" ?>
    <section class="home-section">
        <div class="home-content header">
            <i class='bx bx-menu'></i>
            <span class="text text-white m-0">LIBRARY MANAGEMENT SYSTEM</span>
        </div>
        <hr class=" text-white">
        <div class="col-md-9 col-lg-11 bg-light mt-3 rounded-start-4 bg-transparent" class="container-fuid px-4" role="main" id="main-content" style=" margin:auto; overflow:auto;">
            <main>
                <div class="card border-0 bg-transparent text-white rounded-1 mt-lg-5 rounded-4 p-4">
                    <div class="card-header bg-transparent py-4">
                        <h2 class="mb-5 pb-2 d-grid row card-title px-4">Report books</h2>
                        <div id="message" class="mt-2"></div>
                        <div class="filter-container justify-content-between gap-3 w-100 d-flex my-3">
                            <div class="justify-content-between gap-3 w-25 d-flex">
                                <div class="d-flex w-auto gap-2">
                                    <label for="author" class="py-1">Author:</label>
                                    <select id="author" name="author" class="filter-select filter-input rounded-3 px-2">
                                        <option value="">Select Author</option>
                                        <?php
                                        include 'DBconnect.php';
                                        $result = mysqli_query($connect, "SELECT * FROM author");
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $row['author_id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex w-auto gap-2">
                                    <label for="category" class="py-1">Category:</label>
                                    <select id="category" name="category" class="filter-select filter-input rounded-3 px-2 py-1">
                                        <option value="">Select Category</option>
                                        <?php
                                        include 'DBconnect.php';
                                        $result = mysqli_query($connect, "SELECT * FROM category");
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex w-auto gap-2">
                                    <label for="year" class="py-1">Year:</label>
                                    <input type="number" id="year" name="year" min="1900" max="2099" placeholder="YEAR" step="1" class="filter-input rounded-3 px-2 py-1">
                                </div>
                            </div>
                            <div class="d-flex w-auto gap-2">
                                <label for="year" class="py-1">Search:</label>
                                <input type="text" id="search" placeholder="Search" name="search" class="filter-input rounded-3 px-2 py-1">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-hover bg-light border-0" id="BooksTable">
                            <thead class="border-black table-success">
                                <tr class="rounded-top-4">
                                    <th scope="col">ID
                                    </th>
                                    <th scope="col">Title
                                    </th>
                                    <th scope="col">Authors
                                    </th>
                                    <th scope="col">Categories
                                    </th>
                                    <th scope="col">Year
                                    </th>
                                    <th scope="col">Accounts
                                    </th>
                                    <th scope="col">Copies
                                    </th>
                                    <th scope="col">CD
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success" id="tableBody">
                                <!-- Table rows will be dynamically populated here -->
                            </tbody>
                        </table>

                        <button id="pslip" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <div id="printTable1" class="d-none">
        <style>
            .container {
                max-width: 500px;
                margin: 0 auto;
                padding: 10px;
            }

            .table1 {
                width: 98%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px;
                border: 1px solid #000;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
        <table class="table table1 table-bordered table-hover bg-light border-0" id="BooksTable1">
            <thead class="border-black table-success">
                <tr class="rounded-top-4">
                    <th scope="col">ID
                    </th>
                    <th scope="col">Title
                    </th>
                    <th scope="col">Authors
                    </th>
                    <th scope="col">Categories
                    </th>
                    <th scope="col">Year
                    </th>
                    <th scope="col">Accounts
                    </th>
                    <th scope="col">Copies
                    </th>
                    <th scope="col">CD
                    </th>
                </tr>
            </thead>
            <tbody class="table-light border-success" id="tableBody1">
                <!-- Table rows will be dynamically populated here -->
            </tbody>
        </table>
    </div>

    <!-- book Information Modal -->
    <div class="modal fade" id="bookInfoModal" tabindex="-1" role="dialog" aria-labelledby="bookInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookInfoModalLabel">User Information</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fa fa-book display-1"></i>
                    </div>
                    <div class="text-center mb-3">
                        <h4 id="book_title"></h4>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Authors"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Categories"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Accounts"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Year"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#pslip', function() {
            var printContents = document.getElementById('printTable1').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            window.location.reload();
            document.body.innerHTML = originalContents;
        });
        
        var yearInput = document.getElementById('year');
        var searchInput = document.getElementById('search');
        var authorInput = document.getElementById('author');
        var categoryInput = document.getElementById('category');

        yearInput.addEventListener('change', filterTable);
        searchInput.addEventListener('change', filterTable);
        authorInput.addEventListener('change', filterTable);
        categoryInput.addEventListener('change', filterTable);

        // Function to filter the table based on the selected month and year
        // Function to filter the table based on the selected month and year
        function filterTable() {


            var selectedYear = yearInput.value;
            var selectedSearch = searchInput.value;
            var selectedAuthor = authorInput.value;
            var selectedCategory = categoryInput.value;

            // Make an AJAX request to fetch the filtered data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the table with the fetched data
                    $('#BooksTable').DataTable().destroy(); // Destroy the existing DataTable instance
                    $('#tableBody').html(xhr.responseText); // Insert the fetched data into the table body
                    $('#BooksTable').DataTable({
                        "searching": false,
                        "lengthChange": false,
                        "pageLength": 5,
                        "language": {
                            "zeroRecords": "No matching records found",
                            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                            "infoEmpty": "Showing 0 to 0 of 0 entries",
                            "infoFiltered": "(filtered from _MAX_ total entries)"
                        }
                    }); // Reinitialize the DataTable
                    $('#tableBody1').html(xhr.responseText); // Insert the fetched data into the table body
                }
            };
            xhr.open('GET', 'filter_Books.php?year=' + selectedYear + '&search=' + selectedSearch + '&author=' + selectedAuthor + '&category=' + selectedCategory, true);
            xhr.send();
        }
        $(document).ready(function() {
            $(document).on('click','.clickable-row',function() {
                var bookId = $(this).data('v-book-id');
                var bookTitle = $(this).data('v-book-title');
                var bookYear = $(this).data('v-book-year');
                var bookAuthors = $(this).data('v-book-authors');
                var bookCategories = $(this).data('v-book-categories');
                var bookAccounts = $(this).data('v-book-accounts');

                // Set the modal content with the retrieved data
                $('#book_title').text(bookTitle);
                $('#Book_Categories').text("Categories: " + bookCategories);
                $('#Book_Authors').text("Authors: " + bookAuthors);
                $('#Book_Accounts').text("Accounts: " + bookAccounts);
                $('#Book_Year').text("Year: " + bookYear);
            });
            // Trigger the filtering function when the page loads
            filterTable();
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".Rbo").addClass('active');
            $(".reports-li").addClass('nav-link');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>