<?php
include 'src/Base.php';
$url = '';
$admin = new \Base\Admin();
$return = '';
switch ($_POST['type'])
{
    case 'delete' :
        $return = $admin->deleteUser();
        $url ='admin.php';
        break;
}

echo json_encode(['url' => $url, 'return' => $return]);
