<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 26/08/16
 * Time: 17:56
 */

namespace Tests\Gateway;


use App\Common\Gateway\GatewayInterface;

class FakeGateway implements GatewayInterface
{
    private $store = [];

    public function save($task)
    {
        $this->store[] = $task;

        return $task;
    }

    /**
     * @param $object
     *
     * @return mixed
     */
    public function update($task)
    {
        $this->store[] = $task;

        return $task;
    }

    /**
     * Delete an entity.
     *
     * @param $object
     *
     * @return mixed
     */
    public function delete($object)
    {

    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->store;
    }

    /**
     * @param array $criteria
     */
    public function findOneBy(array $criteria)
    {
        return array_key_exists(0, $this->store) ? $this->store[0] : null;
    }
}
