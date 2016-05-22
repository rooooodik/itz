<?php

namespace itz\file;

/**
 * Interface IDataProvider
 *
 * @package itz\file
 */
interface IDataProvider
{
    /**
     * Returns data from resource
     *
     * @return \Generator
     */
    public function getData();

}