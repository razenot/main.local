<?php
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['torrent'])) {
    $torrent = $data['torrent'];
    try {
        $log = file_put_contents('../../../media/torrent/myserv'.time().'.torrent', file_get_contents($torrent));
        $response = array('status' => 'success', 'data' => json_encode(error_get_last()));
        echo json_encode($response);
    } catch (Exception $e) {
        echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
    }
} else {
    $response = array('status' => 'error', 'message' => 'Данные не были переданы');
    echo json_encode($response);
}
?>