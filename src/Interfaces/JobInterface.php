<?php

namespace Imponeer\Interfaces;

/**
 * This interface defines job
 *
 * @package Imponeer\Interfaces
 */
interface JobInterface
{

    /**
     * Execute job
     *
     * @param \Phar $phar   Opened phar file
     * @param bool $offline Generating for offline mode?
     */
    public function execute(\Phar $phar, $offline);
}