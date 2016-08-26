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

    public function persist($task)
    {
        $this->store[] = $task;

        return end($this->store);
    }

    public function flush()
    {
        return end($this->store);
    }
}
