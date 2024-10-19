<div class="sidebar">
    <div class=" mx-md-3 mx-lg-4 mx-sm-0 logo-details">
        <span class="logo_name">CICTE Library</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="Index.php" class="dash nav-link text-white">
                <i class='bx bxs-home'></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li><!-- 
        <li>
            <a href="home.php" class="nav-link text-white">
                <i class='bx bx-home'></i>
                <span class="link_name">Home</span>
            </a>
        </li> -->
        <li>
            <div class="iocn-link book-li boo au cat acc">
                <a href="#">
                    <i class='bx bx-book'></i>
                    <span class="link_name ">Books</span>
                </a>
                <i class='bx bxs-chevron-down arrow arrows'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Books</a></li>
                <li><a href="Table_books.php" class="nav-link text-white boo">Books</a></li>
                <li><a href="Table_authors.php" class="nav-link text-white au">Authors</a></li>
                <li><a href="Table_categories.php" class="nav-link text-white cat">Categories</a></li>
                <li><a href="Table_accountNo.php" class="nav-link text-white acc">Accounts</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link borrowers-li bor ret nret over">
                <a href="#">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Borrowers</span>
                </a>
                <i class='bx bxs-chevron-down arrow arrows'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Borrowers</a></li>
                <li><a href="Table_borrowers.php" class="nav-link text-white bor">Borrowed</a></li>
                <li><a href="Table_returned.php" class="nav-link text-white ret">Returned</a></li>
                <li><a href="Table_notReturned.php" class="nav-link text-white nret">Not Returned</a></li>
                <li><a href="Table_Overdued.php" class="nav-link text-white over">Overdued</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link nav-link us">
                <a href="Table_userAcc.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Accounts</span>
                </a>
            </div>
        </li>
        <li>
            <div class="iocn-link nav-link req">
                <a href="Request_borrow.php">
                    <i class='bx bxs-comment-dots'></i>
                    <span class="link_name">Requests</span>
                </a>
            </div>
        </li>
        <li>
            <div class="iocn-link reports-li Ent Rbo Ret">
                <a href="#">
                    <i class='bx bxs-report'></i>
                    <span class="link_name">Reports</span>
                </a>
                <i class='bx bxs-chevron-down arrow arrows'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Reports</a></li>
                <li><a href="Report_Entry.php" class="nav-link text-white Ent">Entry</a></li>
                <li><a href="Report_borrowed.php" class="nav-link text-white Ret">Borrowed</a></li>
                <li><a href="Report_books.php" class="nav-link text-white Rbo">Books</a></li>
            </ul>
        </li>
        <li>
            <a href="Maintenance.php" class="main nav-link text-white">
                <i class='bx bx-wrench'></i>
                <span class="link_name">Maintenance</span>
            </a>
        </li>
        <li>
            <a href="Notifications.php" class="Notif nav-link text-white">
                <i class='bx bx-bell'></i>
                <span class="link_name">Notifications</span>
            </a>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <i class="fa fa-user"></i>
                </div>
                <div class="name-job">
                    <div class="profile_name"><?php echo $row['first_name'] ?></div>
                    <div class="job">Admin</div>
                </div>
                <a href="logout.php"><i class='bx bx-log-out'></i></a>
            </div>
        </li>
    </ul>
</div>