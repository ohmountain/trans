<?php

namespace NiwoBundle\Repository;

/**
 * AssistanceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssistanceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findBySid(string $sid)
    {
        $res = $this->findBy(["sid" => $sid]);

        return (count($res) > 0) ? $res[0] : null;
    }
}