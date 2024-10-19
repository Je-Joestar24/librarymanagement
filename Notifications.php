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

    <title>Notifications</title>
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
                        <h2 class="mb-5 pb-2 d-grid row card-title px-4">Notifications</h2>
                        <div id="message" class="mt-2"></div>
                        <div class="filter-container justify-content-between gap-3 w-100 d-flex my-3">

                            <div class="justify-content-between gap-3 w-25 d-flex">
                                <div class="d-flex w-auto gap-2">
                                    <label for="month" class="py-1">Month:</label>
                                    <select id="month" name="month" class="filter-select py-1  filter-input rounded-3 px-2">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="d-flex w-auto gap-2">
                                    <label for="year" class="py-1">Year:</label>
                                    <input type="number" id="year" name="year" min="1900" max="2099" step="1" class="filter-input py-1  rounded-3 px-2">
                                </div>
                                <div class="d-flex w-auto gap-2">
                                    <label for="status" class="py-1">Status: </label>
                                    <select id="status" name="status" class="filter-select py-1 filter-input rounded-3 px-2">
                                        <option value="">status</option>
                                        <option value="1">Returned</option>
                                        <option value="0">Not Returned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <label for="year" class="py-1">Search:</label>
                                <input type="text" id="search" placeholder="Search" name="search" class="filter-input py-1 rounded-3 px-2">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-hover bg-light border-0" id="Notification">
                            <thead class="border-black table-success">
                                <tr class="rounded-top-4">
                                    <th scope="col">
                                        <div class="py-1">#</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">User Name</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Course Year</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Borrowed Book</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Notified At</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div class="py-1">Status</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success" id="tableBody">
                                <!-- Table rows will be dynamically populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <script>

        var currentYear = new Date().getFullYear();

        document.getElementById('year').value = currentYear;

        var monthSelect = document.getElementById('month');

        var currentMonth = new Date().getMonth();

        monthSelect.options[currentMonth].selected = true;

        monthSelect.addEventListener('change', filterTable);

        var yearInput = document.getElementById('year');
        var searchInput = document.getElementById('search');
        var statusInput = document.getElementById('status');
        var monthInput = document.getElementById('month');
        var mTDiv = document.getElementById('mT');

        yearInput.addEventListener('change', filterTable);
        searchInput.addEventListener('change', filterTable);
        statusInput.addEventListener('change', filterTable);
        monthInput.addEventListener('change', filterTable);

        function filterTable() {


            var selectedYear = yearInput.value;
            var selectedSearch = searchInput.value;
            var selectedStatus = statusInput.value;
            var selectedMonth = monthInput.value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the table with the fetched data
                    $('#Notification').DataTable().destroy(); // Destroy the existing DataTable instance
                    $('#tableBody').html(xhr.responseText); // Insert the fetched data into the table body
                    $('#Notification').DataTable({
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
                }
            };
            xhr.open('GET', 'filter_Notifications.php?year=' + selectedYear + '&month=' + selectedMonth + '&search=' + selectedSearch + '&status=' + selectedStatus, true);
            xhr.send();
        }
        $(document).ready(function() {
            // Trigger the filtering function when the page loads
            filterTable();
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".Notif").addClass('active');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>