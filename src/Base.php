<?php
session_start();
include 'AutoLoad.php';
$auto = new AutoLoad();
$auto->autoload();