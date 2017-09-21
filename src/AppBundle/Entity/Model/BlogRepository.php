<?php

namespace AppBundle\Entity\Model;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogRepository extends EntityRepository
{

    public function findAllOrderedByTitle() {
        return $this->getEntityManager()->createQuery('SELECT b from AppBundle:Blog b ORDER BY b.title ASC')->getResult();
    }

}
