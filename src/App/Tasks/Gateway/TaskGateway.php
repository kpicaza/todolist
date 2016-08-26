<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Gateway;
use App\Common\Gateway\GatewayInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * TaskGateway
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskGateway extends \Doctrine\ORM\EntityRepository implements GatewayInterface
{
    /**
     * TaskGateway constructor.
     * @param \Doctrine\ORM\EntityManager $em
     * @param ClassMetadata $class
     */
    public function __construct($em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    /**
     * @param $object
     * @return mixed
     */
    public function save($object)
    {
        $this->_em->persist($object);
        $this->_em->flush();

        return $object;
    }
}
