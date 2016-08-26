<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Common\Gateway;

/**
 * Interface GatewayInterface
 * @package App\Common\Gateway
 */
interface GatewayInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function persist($object);

    /**
     * @return mixed
     */
    public function flush();
}
