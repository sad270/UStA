<?php
namespace USTA\MemberBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class MemberSearch
{
  /**
   * @Assert\Length(max=255)
   * @Assert\NotBlank()
   */
   protected $firstname_lastname;

   /**
    * Set firstname_lastname
    *
    * @param string $firstname_lastname
    * @return Member
    */
   public function setFirstnameLastname($firstname_lastname)
   {
       $this->firstname_lastname = $firstname_lastname;

       return $this;
   }

   /**
    * Get firstname_lastname
    *
    * @return string
    */
   public function getFirstnameLastname()
   {
       return $this->firstname_lastname;
   }
}
