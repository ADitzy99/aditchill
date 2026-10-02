<?php

require_once __DIR__ . '/../Config/database.php';
require_once __DIR__ . '/../Includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {

        $error = 'Username dan password wajib diisi.';

    } else {

        $stmt = $conn->prepare(
            "SELECT id, username, password, role, anggota_id
             FROM users
             WHERE username = ?
             LIMIT 1"
        );

        if (!$stmt) {
            die("Query error: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'anggota_id' => $user['anggota_id']
            ];

            header("Location: /perpus/dashboard.php");
            exit;

        } else {

            $error = "Username atau password salah.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
</head>

<body>

<h2>Login Perpustakaan</h2>

<?php if ($error !== ''): ?>

    <p style="color:red;">
        <?= e($error) ?>
    </p>

<?php endif; ?>

<form method="POST">

    <p>
        <input
            type="text"
            name="username"
            placeholder="Username"
            required
        >
    </p>

    <p>
        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >
    </p>

    <button type="submit">
        Masuk
    </button>

</form>

</body>
</html>