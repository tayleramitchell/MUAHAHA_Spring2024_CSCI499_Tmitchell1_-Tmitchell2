<?php
session_start();

// Check if the user is already logged in, redirect to dashboard if yes
//if (isset($_SESSION['Gmail'])) {
   //header("Location: signupp.php");
    //exit(); 
//} 

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'Room users';

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
   die("Database connection is unsuccessful");
} else {
   echo "Database connection is successful";
};

// Function to establish database connection
function connectToDatabase() {
    global $db_host, $db_user, $db_pass, $db_name;
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to sanitize user input
function sanitizeInput($input) {
    $conn = connectToDatabase();
    return $conn->real_escape_string($input);
}

// Function to handle login
function login() {
    $conn = connectToDatabase();
    
    $email = sanitizeInput($_POST['Gmail']);
    $phone_number = sanitizeInput($_POST['Cell_Num']);

    $sql = "SELECT * FROM room_user___sheet1__1_ WHERE Gmail='$email' AND `Cell Num`='$phone_number'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['Gmail'] = $email;
        $_SESSION['Name'] = $row['Name'];
        header("Location: file:///Applications/XAMPP/xamppfiles/htdocs/TeamProject.html");
        exit();
       // header("Location: dashboard.php");
       // exit();
    } else {
        echo "Invalid email or phone number";
    }

    $conn->close();
}

// Function to handle signup
function signup() {
    $conn = connectToDatabase();
    
    $name = sanitizeInput($_POST['Name']);
    $age = sanitizeInput($_POST['Age']);
    $email = sanitizeInput($_POST['Gmail']);
    $birthday = sanitizeInput($_POST['Bday']);
    $phone_number = sanitizeInput($_POST['Cell_Num']);

    $sql = "INSERT INTO room_user___sheet1__1_ (Name, Age, Gmail, Bday, `Cell Num`) VALUES ('$name', '$age', '$email', '$birthday', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        login();
    } elseif (isset($_POST['signup'])) {
        signup();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login/Signup</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Email: <input type="text" name="Gmail"><br>
        Phone Number: <input type="text" name="Cell_Num"><br>
        <input type="submit" name="login" value="Login">
    </form>

    <h2>Signup</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Name: <input type="text" name="Name"><br>
        Age: <input type="text" name="Age"><br>
        Email: <input type="text" name="Gmail"><br>
        Birthday: <input type="date" name="Bday"><br>
        Phone Number: <input type="text" name="Cell_Num"><br>
        <input type="submit" name="signup" value="Signup">
    </form>
</body>
</html>
