<?php

namespace Base;

use PDO;

/**
 * @proprety int id
 * @proprety string email
 * @proprety string nom
 * @proprety string telephone
 * @proprety string password
 * @proprety int cart_id
 * @proprety int admin
 */
class product__cat extends DataBase
{
    protected $user = [];
    protected $id = NULL;
    protected $nom = NULL;
    protected $prenom = NULL;
    protected $email = NULL;
    protected $adresse;
    protected $code_postal;
    protected $ville;
    protected $phone;
    protected $password;
    protected $newpassword;
    protected $repeatnewpassword;
    /**
     * @return array
     */
    public function checkLogo()
    {
        $type = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $output = [
            'type' => $type
        ];
        if (!in_array("." . $type, $this->extensionType)) {
            $output['error'] = "Format d'image autorisé: " . implode(", ", $this->extensionType);
        }
        return $output;
    }

    /**
     * @param ProductImg $productImg
     * @throws \Exception
     */
    public function setLogo(ProductImg $productImg)
    {
        $pathAvatar = 'data/product_img/';
        $name = $productImg->product_img_id . ".jpg";
        foreach (scandir($pathAvatar) as $avatar) {
            if (pathinfo($avatar, PATHINFO_FILENAME) == pathinfo($name, PATHINFO_FILENAME)) {
                $path = $pathAvatar . $avatar;
                unset($path);
            }
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], $pathAvatar . $name);
        $productImg->name = $_FILES["file"]["name"];
        $productImg->save();
    }

}