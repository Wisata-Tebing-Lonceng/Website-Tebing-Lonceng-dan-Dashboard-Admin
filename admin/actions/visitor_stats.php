<?php
// admin/actions/visitor_stats.php
// Real-time API to fetch physical visitor statistics for charts
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once __DIR__ . '/../../config/Database.php';
$conn = Database::getConnection();

$filter = $_GET['filter'] ?? 'monthly';
$labels = [];
$data = [];

if ($filter === 'daily') {
    // Get last 7 days
    $sql = "SELECT tanggal, jumlah 
            FROM statistik_pengunjung 
            WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            ORDER BY tanggal ASC";
    
    $result = $conn->query($sql);
    
    $stats = [];
    while ($row = $result->fetch_assoc()) {
        $stats[$row['tanggal']] = (int)$row['jumlah'];
    }
    
    // Fill in missing days with 0
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $dayName = date('D', strtotime($date));
        
        // Convert to Indonesian day names
        $daysId = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
        $labels[] = $daysId[$dayName] ?? $dayName;
        $data[] = $stats[$date] ?? 0;
    }
} else {
    // Get monthly data for current year
    $sql = "SELECT MONTH(tanggal) as bulan, SUM(jumlah) as total 
            FROM statistik_pengunjung 
            WHERE YEAR(tanggal) = YEAR(CURDATE())
            GROUP BY MONTH(tanggal)
            ORDER BY bulan ASC";
            
    $result = $conn->query($sql);
    $stats = [];
    while ($row = $result->fetch_assoc()) {
        $stats[$row['bulan']] = (int)$row['total'];
    }
    
    $monthsId = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    // Show from Jan up to current month (or all 12 months)
    $currentMonth = (int)date('n');
    for ($i = 1; $i <= 12; $i++) {
        if ($i <= $currentMonth) {
            $labels[] = $monthsId[$i - 1];
            $data[] = $stats[$i] ?? 0;
        }
    }
}

echo json_encode([
    'success' => true,
    'filter'  => $filter,
    'labels'  => $labels,
    'data'    => $data,
    'timestamp' => date('Y-m-d H:i:s')
]);
