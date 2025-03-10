# PHP Word Censoring Program

## Overview
This is a simple PHP-based word censoring program that filters out offensive or banned words from user-inputted text. The banned words are stored in a database, making it easy to update and manage the list dynamically.

## Features
- Stores banned words in a MySQL database
- Dynamically censors words from user input
- Case-insensitive word filtering
- User-friendly interface with Bootstrap styling
- Displays original and censored text
- Prepared for future admin interface to manage banned words

## Technologies Used
- PHP
- MySQL
- Bootstrap 5
- JavaScript

## Installation

### 1. Clone the Repository
```sh
git clone https://github.com/your-username/php-word-censor.git
cd php-word-censor
```

### 2. Set Up the Database
1. Create a new database named `censor_db`.
2. Run the following SQL command to create the `banned_words` table:
GPT
```sql
CREATE TABLE banned_words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```
3. Insert sample banned words:

```sql
use the insert.php file to insert 200 censored words generated by ChatGPT
```

### 3. Configure Database Connection
Update the `config.php` or the database connection section in `index.php`:

```php
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "censor_db";
```

### 4. Run the Application
Host the project on a local server using XAMPP, WAMP, or a similar PHP server.

- Move the project folder to `htdocs` (if using XAMPP).
- Start Apache and MySQL.
- Open a browser and go to:
  ```
  http://localhost/php-word-censor/
  ```

## Usage
1. Enter a text containing offensive words.
2. Click "Censor Text."
3. The system will replace banned words with asterisks (e.g., "*****").

## Future Improvements
- Admin interface to manage banned words
- Enhanced word matching with regex support
- Option for user-defined banned words

## License
This project is open-source. Feel free to modify and improve it.

## Contributing
Pull requests are welcome! If you have suggestions, open an issue first to discuss changes.

---

⭐ **Star the repo if you found this useful!** 🚀

