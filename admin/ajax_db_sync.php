<?php
/**
 * Bhabha University - Admin AJAX Global Database Sync Endpoint
 */
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');
require_once('inc.global_db_sync.php');

header('Content-Type: application/json');

try {
    $report = bu_run_global_db_sync($db);
    $_SESSION['db_sync_result'] = $report;
    echo json_encode([
        'status'  => $report['success'] ? 'success' : 'warning',
        'message' => 'Database synchronization completed successfully.',
        'report'  => $report
    ]);
} catch (\Throwable $e) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Sync failed: ' . $e->getMessage()
    ]);
}
exit;
