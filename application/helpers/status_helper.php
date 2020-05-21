<?php

function status_success($message) {
    return array(
        'success' => TRUE,
        'message' => $message
    );
}

function status_failure($message) {
    return array(
        'success' => FALSE,
        'message' => $message
    );
}

function status_succeeded($status) {
    return $status['success'] === TRUE;
}

function status_failed($status) {
    return !status_succeeded($status);
}

function status_message($status) {
    if (isset($status)) {
        $type = status_succeeded($status) ? 'toast-success' : 'toast-error';

        echo '<div class="p-2 toast '.$type.'">';
        echo ' '.$status['message'];
        echo '</div>';
    }
}

?>
