<?php

/** Attention la table membershipFees_members est genere automatiquement par Doctrine et utilise un engine InnoDB par defaut, si lors de la creation de cette table vous avez des probleme vous devez donc la creer vous même en lui mettant un engin MyISAM
SQL>>
DROP TABLE usta_membershipFees_members;
CREATE TABLE usta_membershipFees_members (
membership_fee_id INT NOT NULL,
member_id INT NOT NULL,
PRIMARY KEY(membership_fee_id, member_id)
)
DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;

*/

namespace USTA\AccountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MembershipFee
 *
 * @ORM\Table(name="membership_fee",indexes={@ORM\Index(name="membership_fee_reference_idx", columns={"reference"})}, options={"engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="USTA\AccountBundle\Repository\MembershipFeeRepository")
 */
class MembershipFee
{

    /**
     * @ORM\ManyToMany(targetEntity="USTA\MemberBundle\Entity\Member", inversedBy="membershipFees")
     * @ORM\JoinTable(name="membershipFees_members")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    protected $members;

    /**
     * @var int

     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    protected $year;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255,unique=true)
     */
    protected $reference;


    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable = true)
     * @Assert\Length(max=255)
     */
    protected $note;

    /**
    * @var int
    * family id
    *
    */
    protected $family;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return MembershipFee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return MembershipFee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MembershipFee
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return MembershipFee
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set member
     *
     * @param \USTA\MemberBundle\Entity\Member $member
     *
     * @return MembershipFee
     */
    public function setMember(\USTA\MemberBundle\Entity\Member $member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \USTA\MemberBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return MembershipFee
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return MembershipFee
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

    /**
    * Set firstname
    *
    * @param string $firstname
    *
    * @return MembershipFee
    */
    public function setFamily($family)
    {
      $this->family = $family;

      return $this;
    }

    /**
    * Get firstname
    *
    * @return string
    */
    public function getFamily()
    {
      return $this->family;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add member
     *
     * @param \USTA\MemberBundle\Entity\Member $member
     *
     * @return MembershipFee
     */
    public function addMember(\USTA\MemberBundle\Entity\Member $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \USTA\MemberBundle\Entity\Member $member
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
}
