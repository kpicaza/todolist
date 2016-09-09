<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 27/08/16
 * Time: 13:30.
 */

namespace App\Common\Gateway;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class Gateway
 * @package App\Common\Gateway
 */
abstract class Gateway extends EntityRepository implements GatewayInterface
{
    /**
     * TaskGateway constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param ClassMetadata $class
     */
    public function __construct($em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    /**
     * {@inheritdoc}
     *
     * @param $object
     *
     * @return mixed
     */
    public function save($object)
    {
        $this->_em->transactional(function () use ($object) {
            $this->_em->persist($object);
            $this->_em->flush();
        });

        return $object;
    }

    /**
     * {@inheritdoc}
     *
     * @param $object
     *
     * @return mixed
     */
    public function update($object)
    {
        $this->_em->transactional(function () use ($object) {
            $this->_em->merge($object);
            $this->_em->flush();
        });

        return $object;

    }
}
