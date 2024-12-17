Project Structure:

- **README.md**: Project setup instructions.
- **db.php**: Database connection script.
- **register.php**: User registration page.
- **login.php**: User login page.
- **index.php**: Main To-Do list management page.
- **add_task.php**: Script to add new tasks.
- **update_task.php**: Script to update task status (done/undone).
- **delete_task.php**: Script to delete tasks.
- **robots.txt**: robots file.
- **logout.php**: Script to handle user logout.



# To-Do List Application

## Project Overview
This is a simple To-Do List Application built using the LAMP stack (Linux, Apache, MySQL, PHP). The project allows users to register, log in, add tasks, mark them as done or undone, and remove tasks. User information is securely stored in the MySQL database.

## Prerequisites
- Apache Web Server
- MySQL Database
- PHP (>= 7.0)

## Setup Instructions

### Install Prerequisites
To install the necessary applications, use the following commands:

1. **Update your system packages**:
   ```bash
   sudo apt update && sudo apt upgrade -y
   ```

2. **Install Apache**:
   ```bash
   sudo apt install apache2 -y
   ```

3. **Install MySQL**:
   ```bash
   sudo apt install mysql-server -y
   ```

4. **Install PHP**:
   ```bash
   sudo apt install php libapache2-mod-php php-mysql -y
   ```

### Clone the Repository
1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd todo-app
   ```

### Database Setup
1. **Create a new MySQL database named `todo_app`**.
2. **Create the necessary tables by executing the following SQL script in your MySQL console**:
   ```sql
   CREATE DATABASE todo_app;
   USE todo_app;

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(50) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL,
     role ENUM('general', 'admin') DEFAULT 'general',
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );

   CREATE TABLE todos (
     id INT AUTO_INCREMENT PRIMARY KEY,
     user_id INT NOT NULL,
     task VARCHAR(255) NOT NULL,
     status BOOLEAN DEFAULT 0,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
     );

   INSERT INTO todos (user_id, task, status) VALUES
     (1, 'Flag: flag{sql_injection_success}', 0);

   ```

### Configure Database Connection
- Edit the `db.php` file with your database credentials.

### Deploy Files to Apache Server
- Place all the project files in your web server's document root (e.g., `/var/www/html/todo-app`).

### Run the Application
- Access the application by navigating to `http://localhost/todo-app/` in your web browser.

## Security Considerations
- Passwords are hashed using `password_hash()` for secure storage.
- Prepared statements are used to prevent SQL injection.
