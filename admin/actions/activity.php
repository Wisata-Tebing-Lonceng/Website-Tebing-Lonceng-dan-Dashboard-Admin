<?php
// admin/actions/activity.php
// Real-time activity feed: merges recent reviews + gallery submissions
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once __DIR__ . '/../../config/Database.php';
$conn = Database::getConnection();

$limit = (int)($_GET['limit'] ?? 10);
if ($limit < 1 || $limit > 50) $limit = 10;

$activities = [];

// Fetch recent reviews
$sql = "SELECT 
            r.id,
            r.nama,
            r.kesan   AS content,
            r.status,
            r.created_at,
            u.email,
            'review'  AS type
        FROM reviews r
        LEFT JOIN users u ON r.user_id = u.id
        ORDER BY r.created_at DESC
        LIMIT ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $limit);
$stmt->execute();
$reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch recent gallery submissions
$sql2 = "SELECT 
            g.id,
            u.nama,
            g.caption AS content,
            g.status,
            g.created_at,
            u.email,
            g.image_path,
            'gallery' AS type
         FROM galleries g
         JOIN users u ON g.user_id = u.id
         ORDER BY g.created_at DESC
         LIMIT ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('i', $limit);
$stmt2->execute();
$galleries = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt2->close();

// Merge and sort by created_at descending
$activities = array_merge($reviews, $galleries);
usort($activities, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));
$activities = array_slice($activities, 0, $limit);

// Count pending items for badge
$pendingReviews  = $conn->query("SELECT COUNT(*) as c FROM reviews  WHERE status='pending'")->fetch_assoc()['c'];
$pendingGalleries = $conn->query("SELECT COUNT(*) as c FROM galleries WHERE status='pending'")->fetch_assoc()['c'];
$totalReviews    = $conn->query("SELECT COUNT(*) as c FROM reviews")->fetch_assoc()['c'];
$totalGalleries  = $conn->query("SELECT COUNT(*) as c FROM galleries")->fetch_assoc()['c'];

echo json_encode([
    'success'          => true,
    'activities'       => $activities,
    'pending_reviews'  => (int)$pendingReviews,
    'pending_galleries'=> (int)$pendingGalleries,
    'total_reviews'    => (int)$totalReviews,
    'total_galleries'  => (int)$totalGalleries,
    'timestamp'        => date('Y-m-d H:i:s'),
]);
