<?php
if (empty($_POST['list'])) {
  return;
}

// Header and configs
header ('Content-type: application/json; charset=utf-8');
require_once 'mailchimp-config.php';
require_once 'mailchimp.class.php';

$email        = $_POST['email'];
$email_hash   = md5($email);
$list         = $_POST['list'];
$interests    = array();
$merge_fields = $_POST['fields'] ? array('merge_fields' => $_POST['fields']) : array();

if ($_POST['groups']) {
  foreach ($_POST['groups'] as $group) {
    $interests['interests'][$group] = true;
  }
}

// MailChimp constructor begin
$mc = new MailChimp();
$mc->setApiKey($API_KEY);

$user = array(
  'email_address' => $email,
  'status'        => 'subscribed',
);

$user_was   = array_merge($user, $interests);
$user_wasnt = array_merge($user_was, $merge_fields);

$consult = json_decode(json_encode($mc->get('/lists/' . $list . '/members/' . $email_hash)));

if ($consult->status == 404) {
  $result = $mc->post('/lists/' . $list . '/members', $user_wasnt);
} else {
  if ($consult->status == 'unsubscribed') {
    $user_was['status'] = 'pending';
  }
  $result = $mc->patch('/lists/' . $list . '/members/' . $email_hash, $user_was);
}

echo json_encode($result);
