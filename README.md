# User Management API

User Management API is a PHP-based web API for handling user-related operations, such as creating, updating, deleting, and retrieving user information.

## Features

- Create a new user
- Update user details
- Delete a user
- Retrieve user information
- List all users

## Technologies Used

- PHP with PDO for database interaction
- MySQL for user data storage

## Getting Started

### 1\. Clone the repository
git clone https://github.com/mouraleonardo/user-management-api.git

### 2\. Set Up a MySQL Database


Before running the API, you'll need to set up a MySQL database and update the connection details in the code. Follow these steps:

#### Import Database Structure and Sample Data

1.  Open your preferred MySQL database management tool.
2.  Copy and paste the content of the users.sql file into the query window.
3.  Execute the SQL statements to create the vaulteyes database and the users table.

**Notes:**

*   The provided script includes the necessary SQL statements for creating the vaulteyes database and the users table.
*   It also populates the users table with sample data.

### 3\. Run the API

Run the API on a PHP-supported server environment (e.g., WAMP, XAMPP).

Additionally, here's an example of an API endpoint you can use:

API Endpoints
-------------

### Create User:

-   **Endpoint:**

    -   `POST /api`
-   **Request Body:**

    json

-   `{
      "action": "createUser",
      "firstName": "John",
      "lastName": "Doe",
      "username": "johndoe",
      "email": "john.doe@example.com",
      "password": "securepassword"
    }`

    -   **Response:**

    json

-   `{
      "message": "User created successfully",
      "userId": 123
    }`

### Update User:

-   **Endpoint:**

    -   `POST /api`
-   **Request Body:**

    json

-   `{
      "action": "updateUser",
      "userId": 123,
      "firstName": "Updated",
      "lastName": "User",
      "username": "updateduser",
      "email": "updated.user@example.com",
      "password": "newsecurepassword"
    }`

    -   **Response:**

    json

-   `{
      "message": "User updated successfully",
      "userId": 123
    }`

### Delete User:

-   **Endpoint:**

    -   `POST /api`
-   **Request Body:**

    json

-   `{
      "action": "deleteUser",
      "userId": 123
    }`

    -   **Response:**

    json

-   `{
      "message": "User deleted successfully"
    }`

### Get User:

-   **Endpoint:**

    -   `POST /api`
-   **Request Body:**

    json

-   `{
      "action": "getUser",
      "searchTerm": "johndoe"
    }`

    -   **Response:**

    json

-   `{
      "userId": 123,
      "firstName": "John",
      "lastName": "Doe",
      "username": "johndoe",
      "email": "john.doe@example.com"
    }`

### List Users:

-   **Endpoint:**

    -   `POST /api`
-   **Request Body:**

    json

-   `{
      "action": "listUsers"
    }`

    -   **Response:**

    json

-   `[
      {
        "userId": 123,
        "firstName": "John",
        "lastName": "Doe",
        "username": "johndoe",
        "email": "john.doe@example.com"
      },
      // Additional users...
    ]`

Security
-------

-   **Passwords:**

    -   Passwords are securely hashed using the bcrypt algorithm to ensure strong protection against unauthorized access.
-   **Validation:**

    -   Validation checks are implemented to prevent duplicate usernames and emails during both user creation and update operations. This helps maintain the uniqueness of user credentials in the system.
-   **Error Handling:**

    -   The API returns detailed error messages to guide clients in case of issues, promoting transparency and aiding in effective issue resolution.

License
-------

This project is licensed under the MIT License - see the [LICENSE](https://github.com/mouraleonardo/user-management-api?tab=License-1-ov-file) file for details.


Author
------

-   [Leonardo Moura](https://www.linkedin.com/in/mouraleonardo/)
-   [Personal Website](https://mouraleonardo.com)