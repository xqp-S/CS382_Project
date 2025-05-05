<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL); 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gh_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['check_email'])) {
    $Email = $_GET['check_email'];
    $checkEmailSql = "SELECT Email FROM register WHERE Email = ?";
    $stmtCheck = $conn->prepare($checkEmailSql);
    $stmtCheck->bind_param("s", $Email);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
    $stmtCheck->close();
    $conn->close();
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = trim($_POST['Password']);
    $ConfirmPassword = trim($_POST['ConfirmPassword']);
    $Type = 'User'; 
  
    


    $sql = "SELECT Username, Email FROM register WHERE Username = ? OR Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $Username, $Email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['Username'] === $Username) {
            header("Location: Register.html?error=user_exists");
            exit();
        }
        if ($row['Email'] === $Email) {
            header("Location: Register.html?error=email_taken");
            exit();
        }
    }
}
  

    if (empty($Password) || empty($ConfirmPassword)) {
        echo "<script>alert('Please fill in both password fields.'); window.location.href = 'Register.html';</script>";
        exit();
    }

    if ($Password !== $ConfirmPassword) {
        error_log("Passwords dont match");
        header("Location: Register.html?error=passwords");
        exit();
    }
   
    else {
        $Password = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO register (Username, Email, Password, Type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

    
        $stmt->bind_param("ssss", $Username, $Email, $Password, $Type);

        if ($stmt->execute()) {
          
            $_SESSION['Username'] = $Username;
            $_SESSION['Email'] = $Email;

            
            echo "<script>
                    localStorage.setItem('isSignedIn', 'true');
                     localStorage.setItem('userType', 'User');
                    window.location.href = 'index.html';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Registration failed. Please try again.'); window.location.href = 'Register.html';</script>";
            exit();
        }

        $stmt->close();
    }

   
    $stmtCheck->close();

}

$conn->close();
?>
