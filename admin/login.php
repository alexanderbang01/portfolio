<?php
// admin/login.php
session_start();
require_once '../config/database.php';

// Tjek om allerede logget ind
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header('Location: ./');
            exit;
        } else {
            $error = 'Ugyldig brugernavn eller password';
        }
    } else {
        $error = 'Udfyld alle felter';
    }
}
?>
<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Alexander Bang</title>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-black border border-white p-8 rounded-lg">
            <h2 class="text-2xl font-medium mb-6 text-center">Admin Login</h2>

            <?php if ($error): ?>
                <div class="bg-black border border-red-500 text-red-400 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Brugernavn</label>
                    <input type="text" name="username" required
                        class="w-full px-4 py-3 bg-black border border-white rounded focus:border-gray-300 focus:outline-none transition-colors"
                        value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-black border border-white rounded focus:border-gray-300 focus:outline-none transition-colors">
                </div>

                <button type="submit"
                    class="w-full bg-white text-black px-6 py-3 rounded font-medium hover:bg-gray-200 transition-colors">
                    Log ind
                </button>
            </form>
        </div>
    </div>
</body>

</html>