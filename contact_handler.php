<?php
// contact_handler.php - Kun database, ingen email
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Database connection
    $host = 'localhost';
    $dbname = 'portfolio_db';
    $username = 'root';
    $password = '';

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

    // Sanitize and validate input
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        throw new Exception('Alle felter skal udfyldes');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Ugyldig email adresse');
    }

    if (strlen($message) < 10) {
        throw new Exception('Besked skal være mindst 10 tegn lang');
    }

    if (strlen($message) > 5000) {
        throw new Exception('Besked er for lang (max 5000 tegn)');
    }

    // Get client IP
    $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    // Check for spam - max 3 messages per IP per hour
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM messages 
        WHERE ip_address = ? 
        AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)
    ");
    $stmt->execute([$ip]);
    $spamCheck = $stmt->fetch();

    if ($spamCheck['count'] >= 3) {
        throw new Exception('For mange beskeder. Prøv igen senere.');
    }

    // Insert message into database
    $stmt = $pdo->prepare("
        INSERT INTO messages (name, email, message, ip_address, user_agent, created_at) 
        VALUES (?, ?, ?, ?, ?, NOW())
    ");

    $success = $stmt->execute([
        $name,
        $email,
        $message,
        $ip,
        $_SERVER['HTTP_USER_AGENT'] ?? ''
    ]);

    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Tak for din besked! Den er gemt i databasen og jeg vender tilbage hurtigst muligt.'
        ]);
    } else {
        throw new Exception('Der opstod en fejl ved gemning i database.');
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database fejl. Prøv igen senere.'
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
