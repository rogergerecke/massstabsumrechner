<?php
defined('VALID_CALL') or die('Direct Access is not allowed.');

// global object the scale
use App\ScaleComputer\ScaleException;
use App\ScaleUnit;

$scale = new ScaleUnit();


if (isset($_POST['scale'])) {
    $scale->setScaleUnit($_POST['scale']);
} elseif (isset($_GET['scale'])) {
    $scale->setScaleUnit($_GET['scale']);
}

if (isset($_POST['fromUnit'])) {
    $scale->setFromUnit($_POST['fromUnit']);
} elseif (isset($_GET['fromUnit'])) {
    $scale->setFromUnit($_GET['fromUnit']);
}

if (isset($_POST['toUnit'])) {
    $scale->setToUnit($_POST['toUnit']);
} elseif (isset($_GET['toUnit'])) {
    $scale->setToUnit($_GET['toUnit']);
}

if (isset($_POST['inputUnitValue'])) {
    $scale->setInputUnitValue($_POST['inputUnitValue']);
} elseif (isset($_GET['inputUnitValue'])) {
    $scale->setInputUnitValue($_GET['inputUnitValue']);
}

$scale->execute();

/*if (isset($_POST['execute'])) {
    try {
        $scale->execute();
    } catch (ScaleException $e) {
    }
} elseif (isset($_GET['execute'])) {
    try {
        $scale->execute();
    } catch (ScaleException $e) {
    }
}*/

