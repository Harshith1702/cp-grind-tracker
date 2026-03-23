<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$view = $_GET['view'] ?? 'difficulty_stats';
$allowed = ['my_performance', 'weak_topics', 'difficulty_stats', 'streak_history'];
if (!in_array($view, $allowed)) {
    echo json_encode(["error" => "Invalid view"]);
    exit;
}
$db = mysqli_connect("localhost", "root", "your_password", "cp_grind");
if (!$db) {
    echo json_encode(["error" => mysqli_connect_error()]);
    exit;
}
$result = mysqli_query($db, "SELECT * FROM $view");

if (!$result) {
    echo json_encode(["error" => mysqli_error($db)]);
    exit;
}
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
?>
