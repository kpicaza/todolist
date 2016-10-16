<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

use App\Organizations\Entity\OrganizationFactoryInterface;
use App\Organizations\Entity\OrganizationInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Class UserFactory.
 */
class UserFactory
{
    /**
     * Password encoder.
     *
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * Organization factory.
     *
     * @var OrganizationFactoryInterface
     */
    private $organizationFactory;

    /**
     * UserFactory constructor.
     * 
     * @param PasswordEncoderInterface     $encoder
     * @param OrganizationFactoryInterface $organizationFactory
     */
    public function __construct(PasswordEncoderInterface $encoder, OrganizationFactoryInterface $organizationFactory)
    {
        $this->encoder = $encoder;
        $this->organizationFactory = $organizationFactory;
    }

    /**
     * Create a User.
     *
     * @param string                $id
     * @param OrganizationInterface $organization
     * @param string                $username
     * @param string                $email
     * @param string                $password
     * @param array                 $roles
     *
     * @return UserInterface
     */
    public function make($id, OrganizationInterface $organization, $username, $email, $password, array $roles = array())
    {
        $id = new UserId(null === $id ? Uuid::uuid4() : $id);

        return new User(
            $id,
            $organization,
            $username,
            $email,
            $this->encoder->encodePassword($password, ''),
            $roles
        );
    }
}
