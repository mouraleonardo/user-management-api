<?php

// Database connection settings
$host = 'localhost';
$dbname = 'vaulteyes';
$username = 'root';
$password = '';

try {
    // Establish database connection with PDO and use prepared statements
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to check if a username exists
function isUsernameExists($username, $userId) {
    global $pdo;
    try{
        if ($userId === null) {
            $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username]);
        } else {
            $sql = "SELECT COUNT(*) FROM users WHERE username = ? AND id != ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $userId]);
        }
    } catch (PDOException $e) {
        return ['error' => 'Error checking username'];
    }
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Function to check if an email exists
function isEmailExists($email, $userId) {
    global $pdo;
    try{
        if ($userId === null) {
            $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
        } else {
            $sql = "SELECT COUNT(*) FROM users WHERE email = ? AND id != ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $userId]);
        }
    } catch (PDOException $e) {
        return ['error' => 'Error checking email'];
    }
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Function to create a user
function createUser($firstName, $lastName, $username, $email, $password) {
    global $pdo;

    // Validate and sanitize inputs
    $username = filter_var($username, FILTER_DEFAULT);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if username or email already exists
    $usernameExists = isUsernameExists($username, null);
    $emailExists = isEmailExists($email, null);

    if ($usernameExists && $emailExists) {
        return ['error' => 'Username and email already exist'];
    } elseif ($usernameExists) {
        return ['error' => 'Username already exists'];
    } elseif ($emailExists) {
        return ['error' => 'Email already exists'];
    }

    // Validate and hash the password
    if (strlen($password) < 8) {
        return ['error' => 'Password must be at least 8 characters long'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$firstName, $lastName, $username, $email, $hashedPassword]);
        $userId = $pdo->lastInsertId();
        return ['message' => 'User created successfully', 'userId' => $userId];
    } catch (PDOException $e) {
        return ['error' => 'Error creating user'];
    }
}

function updateUser($userId, $firstName, $lastName, $username, $email, $password) {
    global $pdo;

    // Validate and sanitize inputs
    $username = filter_var($username, FILTER_DEFAULT);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if username or email already exists
    $usernameExists = isUsernameExists($username, $userId);
    $emailExists = isEmailExists($email, $userId);

    if ($usernameExists && $emailExists) {
        return ['error' => 'Username and email already exist'];
    } elseif ($usernameExists) {
        return ['error' => 'Username already exists'];
    } elseif ($emailExists) {
        return ['error' => 'Email already exists'];
    }

    // Validate and hash the password
    if (!empty($password) && strlen($password) < 8) {
        return ['error' => 'Password must be at least 8 characters long'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE users SET first_name=?, last_name=?, username=?, email=?, password=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$firstName, $lastName, $username, $email, $hashedPassword, $userId]);
        return ['message' => 'User updated successfully', 'userId' => $userId];
    } catch (PDOException $e) {
        return ['error' => 'Error updating user'];
    }
}

function deleteUser($userId) {
    global $pdo;
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    try {
        if ($stmt->rowCount() === 0) {
            echo json_encode(['error' => 'User not found']);
        } else {
            echo json_encode(['message' => 'User deleted successfully']);
        }
    } catch (PDOException $e) {
        return ['error' => 'Error deleting user'];
    }
}

function getUser($searchTerm) {
    global $pdo;

    // Validate and sanitize input
    $searchTerm = filter_var($searchTerm, FILTER_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE
            id = :searchTerm OR
            username = :searchTerm OR
            email = :searchTerm OR
            CONCAT(first_name, ' ', last_name) LIKE :nameSearch";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':nameSearch', '%' . $searchTerm . '%', PDO::PARAM_STR);

    try {
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return ['error' => 'User not found'];
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        return ['error' => 'Error fetching user'];
    }
}

function listUsers() {
    global $pdo;
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    try {
        if ($stmt->rowCount() === 0) {
            return ['error' => 'No users found'];
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        return ['error' => 'Error fetching users'];
    }
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if data is sent as JSON
    $jsonInput = file_get_contents('php://input');
    $requestData = json_decode($jsonInput, true);

    if ($requestData === null || !isset($requestData['action'])) {
        echo json_encode(['error' => 'Invalid JSON format or action not specified']);
        exit;
    }

    $action = $requestData['action'];

    switch ($action) {
        case 'createUser':
            $firstName = htmlspecialchars($requestData['firstName']);
            $lastName = htmlspecialchars($requestData['lastName']);
            $username = htmlspecialchars($requestData['username']);
            $email = filter_var($requestData['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($requestData['password']);
            // Attempt to create the user
            $result = createUser($firstName, $lastName, $username, $email, $password);

            // Return the result as JSON
            echo json_encode($result);
            break;

        case 'updateUser':
            $userId = filter_var($requestData['userId'], FILTER_VALIDATE_INT);
            $firstName = htmlspecialchars($requestData['firstName']);
            $lastName = htmlspecialchars($requestData['lastName']);
            $username = htmlspecialchars($requestData['username']);
            $email = filter_var($requestData['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($requestData['password']);
            // Attempt to updateUser the user
            $result = updateUser($userId, $firstName, $lastName, $username, $email, $password);

            // Return the result as JSON
            echo json_encode($result);
            break;

        case 'deleteUser':
            if (isset($requestData['userId'])) {
                $userId = filter_var($requestData['userId'], FILTER_VALIDATE_INT);
                if ($userId !== false && $userId > 0) {
                    deleteUser($userId);
                } else {
                    echo json_encode(['error' => 'Invalid user ID']);
                }
            } else {
                echo json_encode(['error' => 'User ID not provided']);
            }
            break;

        case 'getUser':
            // Check if data is sent as JSON
            $jsonInput = file_get_contents('php://input');
            $requestData = json_decode($jsonInput, true);

            if ($requestData === null || !isset($requestData['searchTerm'])) {
                echo json_encode(['error' => 'Invalid JSON format or searchTerm not specified']);
                exit;
            }

            $searchTerm = htmlspecialchars($requestData['searchTerm']);
            $user = getUser($searchTerm);
            echo json_encode($user);
            break;

        case 'listUsers':
            $users = listUsers();
            echo json_encode($users);
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
