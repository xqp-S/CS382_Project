<?php
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gh_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_GET['check_username'])) {
    header('Content-Type: application/json');
    $Username = mysqli_real_escape_string($conn, $_GET['check_username']);

    $checkUserSql = "SELECT Username FROM register WHERE Username = ?";
    $stmtCheck = $conn->prepare($checkUserSql);
    $stmtCheck->bind_param("s", $Username);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    echo json_encode(['exists' => $stmtCheck->num_rows > 0]);

    $stmtCheck->close();
    $conn->close();
    exit();
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM register WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($Password, $user['Password'])) {
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['userType'] = $user['Type'];

            echo json_encode([
                'success' => true,
                'userType' => $user['Type']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Invalid password'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'User not found'
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}


$conn->close();
?>
