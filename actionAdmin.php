<?php
include 'src/Base.php';
$url = '';
$admin = new \Base\Admin();
$return = [];

switch ($_POST['type'])
{
    case 'delete' :
        $url ='admin_user.php';
        $return = ['url' => $url, 'return' => $admin->deleteUser()];
        break;
    case 'modifAdminUser' :
        $url ='admin_user.php';
        $return = [$url, $admin->updateUser()];
        break;
    case 'modifAdminProduct' :
        $url ='admin_user.php';
        $return = [$url, $admin->updateProduct()];
        break;
}

echo json_encode($return);
