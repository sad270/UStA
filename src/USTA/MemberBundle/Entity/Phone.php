<?php

namespace USTA\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use USTA\MemberBundle\Validator\Constraints as USTAMemberAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone
 *
 * @ORM\Table(options={"engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="USTA\MemberBundle\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * @ORM\ManyToOne(targetEntity="USTA\MemberBundle\Entity\Family", inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $family;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Assert\Valid()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="num", type="string", length=20)
     * @Assert\Length(max=20)
     */
    protected $num;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1,  options={"fixed" = true})
     * @Assert\Length(max=1)
     * @USTAMemberAssert\PhoneType
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
     * Set num
     *
     * @param string $num
     * @return Phone
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Phone
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
     * @return Phone
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
     * @return Phone
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
