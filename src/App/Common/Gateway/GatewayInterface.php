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
     * Save an entity.
     *
     * @param $object
     *
     * @return mixed
     */
    public function save($object);

    /**
     * Update an entity.
     *
     * @param $object
     *
     * @return mixed
     */
    public function update($object);

    /**
     * Delete an entity.
     *
     * @param $object
     *
     * @return mixed
     */
    public function delete($object);

    /**
     * Find entity collection.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param null       $limit
     * @param null       $offset
     *
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Find an entity.
     *
     * @param array $criteria
     *
     * @return mixed
     */
    public function findOneBy(array $criteria);
}
