<?php

namespace USTA\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Family
 *
 * @ORM\Table(options={"engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="USTA\MemberBundle\Repository\FamilyRepository")
 */
class Family
{
    /**
     * @ORM\OneToMany(targetEntity="USTA\MemberBundle\Entity\Member", mappedBy="family", cascade={"persist","remove"})
     * @Assert\NotNull()
     */
    protected $members;

    /**
     * @ORM\OneToMany(targetEntity="USTA\MemberBundle\Entity\Address", mappedBy="family", cascade={"persist","remove"})
     * @Assert\NotNull()
     */
    protected $addresses;

    /**
     * @ORM\OneToMany(targetEntity="USTA\MemberBundle\Entity\Phone", mappedBy="family", cascade={"persist","remove"})
     * @Assert\NotNull()
     */
    protected $phones;

    /**
     * @ORM\OneToMany(targetEntity="USTA\MemberBundle\Entity\Email", mappedBy="family", cascade={"persist","remove"})
     * @Assert\NotNull()
     */
    protected $emails;

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
     * @ORM\Column(name="note", type="string", length=255, nullable = true)
     * @Assert\Length(max=255)
     */
    protected $note;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add members
     *
     * @param \USTA\MemberBundle\Entity\Member $members
     * @return Family
     */
    public function addMember(\USTA\MemberBundle\Entity\Member $member)
    {
        $this->members[] = $member;

        $member->setFamily($this);

        return $this;
    }

    /**
     * Add members
     *
     * @param $members
     * @return Family
     */
    public function addMembers($members)
    {
      if(is_array($members)){
        foreach ($members as $member) {
          $this->addMember($member);
        }
      }

      return $this;
    }

    /**
     * Remove members
     *
     * @param \USTA\MemberBundle\Entity\Member $members
     */
    public function removeMember(\USTA\MemberBundle\Entity\Member $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add addresses
     *
     * @param \USTA\MemberBundle\Entity\Address $addresses
     * @return Family
     */
    public function addAddress(\USTA\MemberBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        $addresses->setFamily($this);

        return $this;
    }

    /**
     * Add addresses
     *
     * @param $addresses
     * @return Family
     */
    public function addAddresses($addresses)
    {
      if(is_array($addresses)){
        foreach ($addresses as $address) {
          $this->addAddress($address);
        }
      }

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \USTA\MemberBundle\Entity\Address $addresses
     */
    public function removeAddress(\USTA\MemberBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phones
     *
     * @param \USTA\MemberBundle\Entity\Phone $phones
     * @return Family
     */
    public function addPhone(\USTA\MemberBundle\Entity\Phone $phones)
    {
        $this->phones[] = $phones;

        $phones->setFamily($this);

        return $this;
    }

    /**
     * Add phones
     *
     * @param $phones
     * @return Family
     */
    public function addPhones($phones)
    {
      if(is_array($phones)){
        foreach ($phones as $phone) {
          $this->addPhone($phone);
        }
      }
        return $this;
    }

    /**
     * Remove phones
     *
     * @param \USTA\MemberBundle\Entity\Phone $phones
     */
    public function removePhone(\USTA\MemberBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add emails
     *
     * @param \USTA\MemberBundle\Entity\Email $emails
     * @return Family
     */
    public function addEmail(\USTA\MemberBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        $emails->setFamily($this);

        return $this;
    }

    /**
     * Add emails
     *
     * @param $emails
     * @return Family
     */
    public function addEmails($emails)
    {
      if(is_array($emails)){
        foreach ($emails as $email) {
          $this->addEmail($email);
        }
      }
        return $this;
    }

    /**
     * Remove emails
     *
     * @param \USTA\MemberBundle\Entity\Email $emails
     */
    public function removeEmail(\USTA\MemberBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Family
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
