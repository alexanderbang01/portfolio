<?php
// admin/index.php
session_start();
require_once '../config/database.php';

// Tjek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();

// Håndter actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'mark_read':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("UPDATE messages SET is_read = TRUE WHERE id = ?");
                $stmt->execute([$id]);
                break;

            case 'mark_unread':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("UPDATE messages SET is_read = FALSE WHERE id = ?");
                $stmt->execute([$id]);
                break;

            case 'delete':
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
                $stmt->execute([$id]);
                break;
        }
        header('Location: index.php');
        exit;
    }
}

// Hent statistikker
$stats = [];
$stmt = $db->query("SELECT COUNT(*) as total FROM messages");
$stats['total'] = $stmt->fetch()['total'];

$stmt = $db->query("SELECT COUNT(*) as unread FROM messages WHERE is_read = FALSE");
$stats['unread'] = $stmt->fetch()['unread'];

$stmt = $db->query("SELECT COUNT(*) as today FROM messages WHERE DATE(created_at) = CURDATE()");
$stats['today'] = $stmt->fetch()['today'];

// Hent beskeder
$page = (int)($_GET['page'] ?? 1);
$per_page = 10;
$offset = ($page - 1) * $per_page;

$stmt = $db->prepare("
    SELECT * FROM messages 
    ORDER BY created_at DESC 
    LIMIT ? OFFSET ?
");
$stmt->execute([$per_page, $offset]);
$messages = $stmt->fetchAll();

// Pagination
$stmt = $db->query("SELECT COUNT(*) as total FROM messages");
$total_messages = $stmt->fetch()['total'];
$total_pages = ceil($total_messages / $per_page);
?>
<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Alexander Bang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="bg-black text-white min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900 border-b border-gray-700 p-6">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-medium">Admin Panel</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-400">Velkommen, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <a href="logout.php" class="text-red-400 hover:text-red-300">Log ud</a>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto p-6">
        <!-- Statistikker -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-900 border border-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Total Beskeder</h3>
                <p class="text-3xl font-bold text-blue-400"><?php echo $stats['total']; ?></p>
            </div>
            <div class="bg-gray-900 border border-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Ulæste</h3>
                <p class="text-3xl font-bold text-yellow-400"><?php echo $stats['unread']; ?></p>
            </div>
            <div class="bg-gray-900 border border-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">I dag</h3>
                <p class="text-3xl font-bold text-green-400"><?php echo $stats['today']; ?></p>
            </div>
        </div>

        <!-- Beskeder -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-xl font-medium">Kontaktbeskeder</h2>
            </div>

            <?php if (empty($messages)): ?>
                <div class="p-6 text-center text-gray-400">
                    Ingen beskeder endnu.
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-black border-b border-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Navn</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Dato</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Handlinger</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white">
                            <?php foreach ($messages as $message): ?>
                                <tr class="<?php echo $message['is_read'] ? 'opacity-60' : 'bg-black'; ?>">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($message['is_read']): ?>
                                            <span class="text-green-400">✓ Læst</span>
                                        <?php else: ?>
                                            <span class="text-yellow-400">● Ny</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">
                                        <?php echo htmlspecialchars($message['name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>"
                                            class="text-white hover:text-gray-300">
                                            <?php echo htmlspecialchars($message['email']); ?>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        <?php echo date('d/m/Y H:i', strtotime($message['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                        <button onclick="showMessage(<?php echo $message['id']; ?>)"
                                            class="text-white hover:text-gray-300">Se</button>

                                        <?php if ($message['is_read']): ?>
                                            <form method="POST" class="inline">
                                                <input type="hidden" name="action" value="mark_unread">
                                                <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                                                <button type="submit" class="text-yellow-400 hover:text-yellow-300">Marker ulæst</button>
                                            </form>
                                        <?php else: ?>
                                            <form method="POST" class="inline">
                                                <input type="hidden" name="action" value="mark_read">
                                                <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                                                <button type="submit" class="text-green-400 hover:text-green-300">Marker læst</button>
                                            </form>
                                        <?php endif; ?>

                                        <form method="POST" class="inline" onsubmit="return confirm('Er du sikker på du vil slette denne besked?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                                            <button type="submit" class="text-red-400 hover:text-red-300">Slet</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="p-6 border-t border-white flex justify-center space-x-2">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>"
                                class="px-3 py-2 <?php echo $i === $page ? 'bg-white text-black' : 'bg-black border border-white text-white hover:bg-white hover:text-black'; ?> rounded">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal til at vise beskeder -->
    <div id="messageModal" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
        <div class="bg-black border border-white rounded-lg max-w-4xl w-full mx-4 max-h-[80vh] overflow-y-auto">
            <div class="p-8 border-b border-white flex justify-between items-center">
                <h3 class="text-xl font-medium">Besked Detaljer</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl">✕</button>
            </div>
            <div id="messageContent" class="p-8">
                <!-- Content loads here -->
            </div>
        </div>
    </div>

    <script>
        const messages = <?php echo json_encode(array_column($messages, null, 'id')); ?>;

        function showMessage(id) {
            const message = messages[id];
            if (!message) return;

            document.getElementById('messageContent').innerHTML = `
                <div class="space-y-4">
                    <div><strong>Navn:</strong> ${message.name}</div>
                    <div><strong>Email:</strong> <a href="mailto:${message.email}" class="text-blue-400">${message.email}</a></div>
                    <div><strong>Dato:</strong> ${new Date(message.created_at).toLocaleString('da-DK')}</div>
                    <div><strong>IP:</strong> ${message.ip_address || 'Ukendt'}</div>
                    <div class="border-t border-gray-700 pt-4">
                        <strong>Besked:</strong>
                        <div class="mt-2 p-4 bg-gray-800 rounded whitespace-pre-wrap">${message.message}</div>
                    </div>
                </div>
            `;
            document.getElementById('messageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on outside click
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>