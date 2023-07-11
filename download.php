<?php
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['torrent'])) {
    $torrent = $data['torrent'];
    file_put_contents('myserv'.time().'.torrent', file_get_contents($torrent));
    $response = array('status' => 'success');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Данные не были переданы');
    echo json_encode($response);
}
?>