<?php

namespace itz;

use itz\file\IDataProvider;

/**
 * Class Counter
 *
 * @package itz
 */
class Counter
{
    protected $dp;

    /**
     * Counter constructor.
     *
     * @param IDataProvider $dp
     */
    public function __construct(IDataProvider $dp)
    {
        $this->dp = $dp;
    }

    /**
     * @param $countValues
     * @return array
     */
    public function getMaxRepeatableValues($countValues)
    {
        $result = [];
        foreach ($this->dp->getData() as $string) {
            if (!isset($result[$string])) {
                $result[$string] = 0;
            }
            $result[$string]++;
        }
        unset($result["\n"]);
        arsort($result);
        return array_slice($result, 0, $countValues);
    }

}