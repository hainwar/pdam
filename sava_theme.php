<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['dark_theme'])) {
    $_SESSION['dark_theme'] = $data['dark_theme'];
}
