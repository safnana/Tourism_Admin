<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id_admin, nama_admin, usn_admin, email_admin FROM admin WHERE usn_admin = ? AND pass_admin = ?";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['nama_admin'] = $row['nama_admin'];
            $_SESSION['usn_admin'] = $row['usn_admin'];
            $_SESSION['email_admin'] = $row['email_admin'];
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Username atau password salah";
            header("Location: login.php");
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['login_error'] = "Username atau password tidak boleh kosong";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['login_error'] = "Metode permintaan tidak valid";
    header("Location: login.php");
    exit();
}
?>
