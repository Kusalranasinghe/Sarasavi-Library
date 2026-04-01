# Sarasavi Library Management System

![Library](https://img.shields.io/badge/Project-Library%20Management-blue)
![PHP](https://img.shields.io/badge/PHP-8.x-brightgreen)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)

**Collaborators:**  
- Sathira Sugeesvara  
- Kusal Ranasinghe  

---

## 📌 Project Overview

The **Sarasavi Library Management System** is a web-based library management solution that allows **Super Admin**, **Admin**, and **User** roles to perform their respective operations. It is designed for small to medium libraries to track books, users, and borrowing requests efficiently.

**Key Features:**
- Role-based access: Super Admin, Admin, User
- Approve/Reject User and Admin registration requests
- Manage books: Add, Edit, Delete, View
- Track borrow requests and history
- Simple UI, easy to use
- Plain password login (no hashing for demo purposes)

---

## 🖥️ Roles & Permissions

| Role | Permissions |
|------|-------------|
| **Super Admin** | Manage Admin accounts, approve/reject Admin registration, full access to all users and books |
| **Admin** | Approve/reject User registration requests, manage books, view borrow requests and history |
| **User** | Request books, view own borrow history, view available books |

---

## ⚡ Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript  
- **Backend:** PHP 8.x  
- **Database:** MySQL / MariaDB  
- **Server:** XAMPP / Localhost  

---

## 🔧 Installation Instructions

1. Install **XAMPP** or any local server environment.  
2. Copy the project folder to `htdocs/SarasaviLibrary`.  
3. Create a MySQL database, e.g., `sarasavi_library`.  
4. Import the provided SQL dump (`database.sql`) or create tables manually.  
5. Update database credentials in `includes/database.php`:
    ```php
    $conn = mysqli_connect("localhost","root","","sarasavi_library");
    ```
6. Open the project in a browser:
    ```
    http://localhost/SarasaviLibrary/login.php
    ```

---

## 📝 How to Use

### Super Admin
- Can manage Admins and approve/reject Admin requests.
- Can manage Users and approve/reject User requests.
- Can manage borrow and approve/reject borrow requests.
- Full access to all users and books.

### Admin
- Approve/reject User registration requests.
- Manage books: Add, Edit, Delete, View.
- View borrow requests and history.

### User
- Register as a user and wait for Admin approval.
- Request books (if borrowing system enabled in future updates).

---

## 💡 Notes
   
- Admins cannot delete or edit other Admins or Super Admins.  
- Both Admins and Super Admins can hadle users and books.
- Only Super Admin can create Admins.

---

## 🛠️ Future Improvements

- Implement **password hashing** for security.  
- Search and filter functionality for books.  
- Enhanced UI with Bootstrap or TailwindCSS.  
- Email notifications for approvals and borrow requests.

---

## 📌 Contact

**Project Collaborators:**

Sathira Sugeesvara
Kusal Ranasinghe

Email (Sathira): [sathirasugeesvara@gmail.com]
Email (Kusal): [dananjayakusal39@gmail.com]
