<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'login';

// Connect to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user actions (accept or reject)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $user_id = intval($_GET['id']);
    
    if ($action === 'accept' || $action === 'reject') {
        $status = $action === 'accept' ? 'accepted' : 'rejected';

        // Update user status in the database
        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-table th, .user-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .user-table th {
            background-color: #2c3e50;
            color: white;
        }
        .user-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .accept-button {
            background-color: #28a745;
        }
        .reject-button {
            background-color: #dc3545;
        }
        .accept-button:hover {
            background-color: #218838;
        }
        .reject-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Admin Panel - Manage Users</h1>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <a href="?action=accept&id=<?php echo $row['id']; ?>" class="action-button accept-button">Accept</a>
                                <a href="?action=reject&id=<?php echo $row['id']; ?>" class="action-button reject-button">Reject</a>
                            <?php else: ?>
                                <span>Action Taken</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
