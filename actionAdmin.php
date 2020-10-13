<?php
include 'src/Base.php';
$url = '';
$admin = new \Base\Admin();
$product = new \Base\product__cat();
$return = [];

switch ($_POST['type']) {
    case 'delete' :
        $url = 'admin_user.php';
        $return = ['url' => $url, 'return' => $admin->deleteUser()];
        break;
    case 'modifAdminUser' :
        $url = 'admin_user.php';
        $return = [$url, $admin->updateUser()];
        break;
    case 'delete' :
        $url = 'admin_user.php';
        $return = [$url, $product->deleteProduct()];
        break;
    case 'modifAdminProduct' :
        $url = 'admin_user.php';
        $return = [$url, $product->updateProduct()];
        break;
    case 'addproduct' :
        $url = 'admin_user.php';
        $return = [$url, $product->addProduct()];
        break;
    case 'addcategorie' :
        $url ='admin_add_categorie.php';
        $return = [$url, $product->addCategorie()];
        break;

}

echo json_encode($return);