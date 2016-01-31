<?php

namespace USTA\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use USTA\UserBundle\Validator\CheckEmailAndCode;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**

 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="USTA\UserBundle\Repository\UserRepository")
 * @CheckEmailAndCode()
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\OneToOne(targetEntity="USTA\UserBundle\Entity\Invitation", inversedBy="user")
    * @ORM\JoinColumn(referencedColumnName="code")
    * @Assert\NotNull(message="Your invitation is wrong", groups={"Registration"})
    */
    protected $invitation;

    public function __construct()
    {
        parent::__construct();
        // your own logic/ your own construct
    }

    public function setInvitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation()
    {
        return $this->invitation;
    }
}
