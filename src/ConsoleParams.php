<?php

namespace itz;

/**
 * Class ConsoleParams
 *
 * @package itz
 */
class ConsoleParams
{
    /**
     * @param $paramC
     * @return string
     */
    public static function getParam($paramC)
    {
        $result = null;
        if (isset($_SERVER['argv'][$paramC])) {
            $result = $_SERVER['argv'][$paramC];
        }
        return $result;
    }

}