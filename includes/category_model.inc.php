<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

function getCategory($pdo) {
    try {
        $prpd_stmt = $pdo->prepare("SELECT category_id, category_name FROM categories");
        $prpd_stmt->execute();
        return $prpd_stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return [];
    }
}
