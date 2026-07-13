<?php
require 'config.php';

header('Content-Type: application/json');

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id > 0) {
    // Read the current status
    $stmt = mysqli_prepare($conn, "SELECT status FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);

    if ($row) {
        // Flip 0 -> 1 or 1 -> 0
        $newStatus = $row['status'] ? 0 : 1;

        $update = mysqli_prepare($conn, "UPDATE users SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($update, "ii", $newStatus, $id);
        mysqli_stmt_execute($update);
        mysqli_stmt_close($update);

        echo json_encode(["success" => true, "status" => $newStatus]);
        exit;
    }
}

echo json_encode(["success" => false]);
