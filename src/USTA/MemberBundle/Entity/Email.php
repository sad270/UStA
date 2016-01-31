<?php

namespace USTA\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use USTA\MemberBundle\Validator\Constraints as USTAMemberAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Email
 *
 * @ORM\Table(options={"engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="USTA\MemberBundle\Repository\EmailRepository")
 */
class Email
{
    /**
     * @ORM\ManyToOne(targetEntity="USTA\MemberBundle\Entity\Family", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    protected $family;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Length(max=255)
     * @Assert\Email(checkMX=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1,  options={"fixed" = true})
     * @Assert\Length(max=1)
     * @USTAMemberAssert\EmailType
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(max=255)
     */
    protected $name;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Email
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Email
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set family
     *
     * @param \USTA\MemberBundle\Entity\Family $family
     * @return Email
     */
    public function setFamily(\USTA\MemberBundle\Entity\Family $family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \USTA\MemberBundle\Entity\Family
     */
    public function getFamily()
    {
        return $this->family;
    }
}
