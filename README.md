Library Management System for CICTE - Western Leyte College
This project is a Library Management System designed specifically for the College of Information Communication Technology and Engineering (CICTE) at Western Leyte College. It allows administrators, librarians, and students to efficiently manage library resources, track book borrowing, monitor attendance, and more.

Features
Admin and Librarian Management
Admin Access: Admins are responsible for system maintenance, including the ability to add, edit, and remove librarian accounts.
Librarian Access: Librarians handle day-to-day operations like book management, borrowing requests, and tracking user activity.

Book Management

Add New Books: Librarians can add new books to the system with detailed information such as title, author, category, publication year, available copies, and CD copies (if applicable).
Search Functionality: Users can search for books by title, category, or author.

Borrow Books: Users can request to borrow books, and librarians manage borrowing processes by setting due dates and tracking overdue books.

Borrowing Management
Track Borrowed Books: Librarians can track which books are borrowed, their return dates, and overdue statuses.

Overdue Notifications: The system automatically flags overdue books and manages the notification process for borrowers.
Library Attendance Tracking

Student ID Check-In: Students scan their IDs when entering the library, and the system logs their attendance for future reporting.
Reports and Notifications

Generate Reports: Librarians can generate reports on overdue books, borrow history, and user attendance.
Automated Notifications: Borrowers are notified automatically when their borrowed books are overdue or need to be returned.

Technologies Used
PHP: Backend server logic and database interaction.
MySQL: Database management for storing books, users, borrowing records, and attendance.
Bootstrap: Responsive design and front-end UI components.
CSS: Custom styles for the user interface.
jQuery & JavaScript: Client-side form validation and interactive elements.
HTML: Structure and layout for web pages.

Getting Started

Prerequisites
XAMPP (or any local server with PHP and MySQL support).
Basic knowledge of PHP, MySQL, and local server configuration.
Installation

Clone the Repository:
git clone https://github.com/yourusername/library-management-system.git

Import the Database:

Open phpMyAdmin.
Create a new database.
Import the provided db/l_management.sql file into the new database.
Configure Database Settings:

Open DBconnect.php.
Update the database name, username, and password according to your local server configuration.
Start the Local Server:

Open XAMPP Control Panel (or your local server).
Start Apache and MySQL services.
Access the Application:

In your web browser, navigate to:
http://localhost/library-management-system

Screenshots

Dashboard
![image](https://github.com/user-attachments/assets/961af109-ac30-4ba1-8b8a-79998989f0a9)


Book Management
![image](https://github.com/user-attachments/assets/3cd7970a-ca99-4457-bb66-82ab44a0a96a)
![image](https://github.com/user-attachments/assets/dbbaf52f-efc2-4f10-b5ce-21828df79b9f)


Borrowing System
![image](https://github.com/user-attachments/assets/c40241a4-e184-4ad3-8cde-85e772296b54)
![image](https://github.com/user-attachments/assets/3305a173-9360-4579-a433-cfe93bee0ab4)


An overview of the borrowing process and overdue books.
