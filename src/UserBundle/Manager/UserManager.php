<?php

namespace UserBundle\Manager;

use Doctrine\ORM\EntityManager;


class UserManager {

    private $entityManager;

    public function __construct(EntityManager $entityManager){

        $this->entityManager = $entityManager;

        }


    public function save($entity)
    {
        $entity->setCreatedDate(new \DateTime("now"));
        $entity->setModifiedDate(new \DateTime("now"));

       
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}