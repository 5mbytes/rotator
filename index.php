<?php

$rotatorId = isset($_GET['rid']) ? $_GET['rid'] : '';

if (!preg_match('/^[0-9a-f]{16}$/', $rotatorId)) {
    die('Please set a correct rotator ID');
}

require('config.php');
require('src/require.php');


// Rotation

$repository = new MySqlBannerRotatorRepository(new XCacheCachingEngine());

try {
    $rotator = $repository->rotator($rotatorId);
    $banner = $rotator->rotate();
} catch (Exception $e) {
    die('<!--'.$e->getMessage().'-->');
}


// Rendering

include 'template.php';
