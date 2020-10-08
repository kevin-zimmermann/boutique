<?php
include 'src/Base.php';
$url = '';
$admin = new \Base\Admin();
$return = [];

switch ($_POST['type'])
{
    case 'delete' :
        $url ='admin.php';
        $return = ['url' => $url, 'return' => $admin->deleteUser()];
        break;
    case 'modifAdminUser' :
        $url ='admin.php';
        $return = [$url, $admin->updateUser()];
        break;
}

echo json_encode($return);
