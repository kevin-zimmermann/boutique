<?php
include 'src/Base.php';
$search = new \Base\Search();

echo json_encode($search->getSearch());