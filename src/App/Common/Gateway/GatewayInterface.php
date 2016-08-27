<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Common\Gateway;

/**
 * Interface GatewayInterface.
 */
interface GatewayInterface
{
    /**
     * @param $object
     *
     * @return mixed
     */
    public function save($object);

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param null       $limit
     * @param null       $offset
     *
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param array $criteria
     *
     * @return mixed
     */
    public function findOneBy(array $criteria);
}
