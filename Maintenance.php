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

    <title>Maintenance</title>
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

<style>
    @media print {

        /* Hide all elements except the table and its contents */
        body * {
            visibility: hidden;
        }

        .table,
        .table * {
            visibility: visible;
        }

        /* Ensure the table takes up the entire printed page */
        .table {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

<body>

    <?php include "sidebar.php" ?>
    <section class="home-section">
        <div class="home-content header">
            <i class='bx bx-menu'></i>
            <span class="text text-white m-0">LIBRARY MAINTENANCE</span>
        </div>
        <hr class=" text-white">
        <div class="col-md-9 col-lg-11 bg-light mt-3 rounded-start-4 bg-transparent" class="container-fuid px-4" role="main" id="main-content" style=" margin:auto; overflow:auto;">
            <main>
                <div class="card border-0 bg-transparent text-white rounded-1 rounded-4 p-4">
                    <div class="card-header bg-transparent border-0">
                        <div id="message" class="mt-2"></div>
                    </div>
                    <div class="card-body">
                        <h2 class="mb-4 d-grid row card-title rounded-2 px-3 bg-success p-2">Books Table</h2>
                        <div class="my-2 filter-container justify-content-between gap-3 w-100 d-flex p-2">

                            <div class="justify-content-between gap-2 w-50 d-flex">
                                <div class="d-flex w-auto gap-1">
                                    <label for="author" class="my-1">Author:</label>
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
                                <div class="d-flex w-auto gap-1">
                                    <label for="category" class="my-1">Category:</label>
                                    <select id="category" name="category" class="filter-select filter-input rounded-3 px-2">
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
                                <div class="d-flex w-auto gap-1">
                                    <label for="year" class="my-1">Year:</label>
                                    <input type="number" id="year" name="year" placeholder="YYYY" min="1900" max="2099" step="1" class="filter-input rounded-3 px-2">
                                </div>
                                <div class="d-flex w-auto gap-1">
                                    <label for="Status" class="my-1">Status:</label>
                                    <select id="status" name="status" class="filter-select filter-input rounded-3 px-2">
                                        <option value="0">Select Status</option>
                                        <option value="1">Available</option>
                                        <option value="2">Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex w-auto gap-1">
                                <label for="year" class="my-1">Search:</label>
                                <input type="text" id="search" placeholder="Search" name="search" class="filter-input rounded-3 px-2 py-1">
                            </div>
                        </div>
                        <table class="table table-sm table-bordered table-hover bg-light border-0" id="BooksTable">
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
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success" id="tableBody">
                                <!-- Table rows will be dynamically populated here -->
                            </tbody>
                        </table>

                        <h2 class="my-2 d-grid row card-title rounded-2 px-3 bg-success p-2">Users Table</h2>
                        <div class="filter-container justify-content-between my-2 p-2 gap-3 w-100 d-flex">
                            <div class="justify-content-between gap-2 w-25 d-flex">
                                <div class="d-flex w-auto gap-1">
                                    <label for="course" class="my-1">Course:</label>
                                    <select id="course" name="course" class="filter-select filter-input rounded-3 px-2">
                                        <option value="0">Course</option>
                                        <?php
                                        include 'DBconnect.php';
                                        $result = mysqli_query($connect, "select * from courses");
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $row['course_id'] ?>"> <?php echo $row['course_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex w-auto gap-1">
                                    <label for="Syear" class="my-1">Year:</label>
                                    <input type="number" id="Syear" placeholder="YYYY" name="Syear" min="1" max="5" step="1" class="filter-input rounded-3 px-2">
                                </div>
                            </div>
                            <div class="d-flex w-auto gap-1">
                                <label for="year" class="my-1">Search:</label>
                                <input type="text" id="searchS" placeholder="Search" name="searchS" class="filter-input py-1 rounded-3 px-2">
                            </div>
                        </div>
                        <table class="table table-sm table-bordered table-hover bg-light border-0" id="usersTable">
                            <thead class="border-black table-success">
                                <tr class="rounded-top-4">
                                    <th scope="col" class="text-center">
                                        <div class="py-1">User ID</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Username</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Email</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div class="py-1">Year Course</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success" id="usersBody">
                                <!-- Table rows will be dynamically populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <!-- User Information Modal -->
    <div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="userInfoModalLabel">User Information</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fa fa-user display-1"></i>
                    </div>
                    <div class="text-center mb-3">
                        <h4 id="userName"></h4>
                    </div>
                    <div class="text-center mb-3">
                        <p id="courseYear"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="email"></p>
                    </div>
                </div>
            </div>
        </div>
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
        var yearInput = document.getElementById('year');
        var searchInput = document.getElementById('search');
        var authorInput = document.getElementById('author');
        var categoryInput = document.getElementById('category');
        var statusInput = document.getElementById('status');

        var searchUInput = document.getElementById('searchS');
        var courseYInput = document.getElementById('course');
        var cYearInput = document.getElementById('Syear')

        searchUInput.addEventListener('change', filterTable1);
        courseYInput.addEventListener('change', filterTable1);
        cYearInput.addEventListener('change', filterTable1);

        yearInput.addEventListener('change', filterTable);
        searchInput.addEventListener('change', filterTable);
        authorInput.addEventListener('change', filterTable);
        categoryInput.addEventListener('change', filterTable);
        statusInput.addEventListener('change',filterTable );

        // Function to filter the table based on the selected month and year
        function filterTable1() {


            var selectedCYear = cYearInput.value;
            var selectedUSearch = searchUInput.value;
            var selectedcourse = courseYInput.value;

            // Make an AJAX request to fetch the filtered data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the table with the fetched data
                    $('#usersTable').DataTable().destroy(); // Destroy the existing DataTable instance
                    $('#usersBody').html(xhr.responseText); // Insert the fetched data into the table body

                    $('#usersTable').DataTable({
                        "searching": false,
                        "lengthChange": false,
                        "pageLength": 4,
                        "language": {
                            "zeroRecords": "No matching records found",
                            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                            "infoEmpty": "Showing 0 to 0 of 0 entries",
                            "infoFiltered": "(filtered from _MAX_ total entries)"
                        }
                    }); // Reinitialize the DataTable

                }
            };
            xhr.open('GET', 'Maintain_user.php?year=' + selectedCYear + '&search=' + selectedUSearch + '&course=' + selectedcourse, true);
            xhr.send();
        }
        // Function to filter the table based on the selected month and year
        function filterTable() {

            var selectedStatus = statusInput.value;
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
                    $('#users').DataTable().destroy();
                    $('#tableBody').html(xhr.responseText); // Insert the fetched data into the table body

                    $('#BooksTable').DataTable({
                        "searching": false,
                        "lengthChange": false,
                        "pageLength": 4,
                        "language": {
                            "zeroRecords": "No matching records found",
                            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                            "infoEmpty": "Showing 0 to 0 of 0 entries",
                            "infoFiltered": "(filtered from _MAX_ total entries)"
                        }
                    }); // Reinitialize the DataTable

                }
            };
            xhr.open('GET', 'filter_maintenance.php?year=' + selectedYear + '&status=' + selectedStatus + '&search=' + selectedSearch + '&author=' + selectedAuthor + '&category=' + selectedCategory, true);
            xhr.send();
        }
        $(document).ready(function() {
            $(document).on('click','.clickable-row1', function() {
                var bookId = $(this).data('v-book-id');
                var bookTitle = $(this).data('v-book-title');
                var bookYear = $(this).data('v-book-year');
                var bookAuthors = $(this).data('v-book-authors');
                var bookCategories = $(this).data('v-book-categories');
                var bookAccounts = $(this).data('v-book-accounts');
                //alert(bookId + " " + bookTitle + " " + bookYear + " " + bookAuthors + " " + bookCategories + " " + bookAccounts);
                // Set the modal content with the retrieved data
                $('#book_title').text(bookTitle);
                $('#Book_Categories').text("Categories: " + bookCategories);
                $('#Book_Authors').text("Authors: " + bookAuthors);
                $('#Book_Accounts').text("Accounts: " + bookAccounts);
                $('#Book_Year').text("Year: " + bookYear);
            });
            // Event delegation for the clickable rows
            $(document).on('click', '.clickable-row', function() {
                var userName = $(this).data('user-name');
                var courseYear = $(this).data('course-year');
                var email = $(this).data('email');

                // Set the modal content with the retrieved data
                $('#userName').text(userName);
                $('#courseYear').text(courseYear);
                $('#email').text(email);

                // Show the modal
                $('#userInfoModal').modal('show');
            });
            // Trigger the filtering function when the page loads
            filterTable();
            filterTable1();
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".main").addClass('active');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>