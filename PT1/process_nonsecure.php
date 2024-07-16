<?php 

include 'connect.php';

try {
    $conn=new PDO("mysql:host=$servername;dbname=$dbname, $username, $password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':password', $inputPassword);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " .$e->getMessage();
}
$conn = null;
?>