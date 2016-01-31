<?php
namespace USTA\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ORM\Entity
* @ORM\Entity(repositoryClass="USTA\UserBundle\Repository\InvitationRepository")
*/
class Invitation
{
    /**
    * @ORM\Id @ORM\Column(type="string", length=6)
    * @Assert\NotNull()
    */
    protected $code;

    /**
    * @ORM\Column(type="string", length=256)
    * @Assert\NotNull()
    */
    protected $email;

    /**
    * @ORM\Column(type="string", length=256)
    * @Assert\NotNull()
    */
    protected $firstname;

    /**
    * @ORM\Column(type="string", length=256)
    * @Assert\NotNull()
    */
    protected $lastname;

    /**
     * @ORM\OneToOne(targetEntity="USTA\UserBundle\Entity\User", mappedBy="invitation")
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\NotNull()
     */
    protected $date;

    /**
     * When sending invitation be sure to set this value to `true`
     *
     * It can prevent invitations from being sent twice
     *
     * @ORM\Column(type="boolean")
     */
    protected $sent = false;

    public function __construct()
    {
        // generate identifier only once, here a 6 characters length code
        $this->date = new \Datetime("now");
        $this->code = substr(md5(uniqid(rand(), true)), 0, 6);

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname()
    {
        return ucfirst(strtolower($this->firstname));
    }

    public function setFirstname($firstname)
    {
        $this->firstname = ucfirst(strtolower($firstname));

        return $this;
    }

    public function getLastname()
    {
        return strtoupper($this->lastname);
    }

    public function setLastname($lastname)
    {
        $this->lastname = strtoupper($lastname);

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function isSent()
    {
        return $this->sent;
    }

    public function send()
    {
        $this->sent = true;

        return $this;
    }
}
