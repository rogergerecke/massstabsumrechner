<?php
define('VALID_CALL', true);
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once './function_handler.php';
if ($scale->getScaleUnit())  echo $scale->getScaleUnit();
echo'<br> Remove php time from .style.css and .js';