<?php

require(__DIR__ . '/vendor/autoload.php');

try {
    $counter = new \itz\Counter(
        new \itz\file\Reader(\itz\ConsoleParams::getParam(1))
    );
    foreach ($counter->getMaxRepeatableValues(2) as $str => $cnt) {
            echo rtrim($str) . ": $cnt\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
