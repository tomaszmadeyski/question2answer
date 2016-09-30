<?php
require_once 'qa-include/qa-base.php';

require_once QA_INCLUDE_DIR.'qa-app-users.php';
require_once QA_INCLUDE_DIR.'db/selects.php';

$userid = $_GET['username'];

$userData = qa_db_select_with_pending(qa_db_user_account_selectspec($userid, false));

unset($userData['passsalt']);
unset($userData['passcheck']);

if (empty($userData)) {
    echo json_encode(array());
    return;
}

echo json_encode(array('id' => $userData['userid'], 'points' => $userData['points']));

