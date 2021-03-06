<?php

namespace USTA\UserBundle\Repository;

/**
 * InvitationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvitationRepository extends \Doctrine\ORM\EntityRepository
{
  public function CheckEmailAndCode($email, $code)
  {
    $qb = $this->createQueryBuilder('i');

    // On peut ajouter ce qu'on veut avant
    $qb
      ->where('i.email = :email')
      ->andWhere('i.code = :code')
      ->setParameter('email', $email)
      ->setParameter('code', $code)
    ;
    return $qb
      ->getQuery()
      ->getResult()
    ;

  }
  public function getUnusedInvitation()
  {
    $qb = $this->createQueryBuilder('i');

    // On peut ajouter ce qu'on veut avant
    $qb->select('i')->leftjoin('i.user', 'u')->where($qb->expr()->isNull('u.id'));
    ;
    return $qb
      ->getQuery()
      ->getResult()
    ;

  }
  public function getAllInvitationOrderByDate()
  {
    $qb = $this->createQueryBuilder('i');

    // On peut ajouter ce qu'on veut avant
    $qb
      ->select('i')
      ->leftjoin('i.user', 'u')
      ->addSelect('u')
      ->orderBy('i.date', 'DESC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;

  }

  public function getUsedInvitation()
  {
    $qb = $this->createQueryBuilder('i');

    // On peut ajouter ce qu'on veut avant
    $qb
      ->select('i')
      ->join('i.user', 'u')
      ->addSelect('u')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;

  }
  public function CheckCodeExpiration($code)
  {
    $qb = $this->createQueryBuilder('i');

    // On peut ajouter ce qu'on veut avant
    $qb
      ->where('i.expire <=' . new \DateTime('now'))
      ->andWhere('i.code = :code')
      ->setParameter('email', $email)
      ->setParameter('code', $code)
    ;
    return $qb
      ->getQuery()
      ->getResult()
    ;

  }
}
