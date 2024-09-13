<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ares_suplementos"); // Conecte ao banco de dados

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (isset($_POST['register'])) {
        // Registro de novo usuário
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "Conta criada com sucesso!";
            header('Location: index.php');
        } else {
            echo "Erro ao criar conta: " . $conn->error;
        }
    } elseif (isset($_POST['login'])) {
        // Verificar login
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['email'];
                header('Location: /inicial/main.html');
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Usuário não encontrado!";
        }
    }
}
?>
