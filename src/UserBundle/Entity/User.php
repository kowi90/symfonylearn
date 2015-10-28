<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @UniqueEntity("email",message="Email adress already exists")
 * @UniqueEntity("username",message="Username adress already exists")
 */

class User implements UserInterface
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
protected $id;
    
    /**
     * @ORM\Column(type="string", length=30)
     */
protected $email;
    
     /**
     * @ORM\Column(type="string", length=30)
     */
protected $username;

     /**
      * @ORM\Column(type="string", length=30)
      * @Assert\Length(
      *      min = 8,
      *      minMessage = "Your password must be at least {{ limit }} characters long",
      * )
     */
protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
protected $created_date;

    /**
     * @ORM\Column(type="datetime")
     */
protected $modified_date;

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
     *
     * @return User
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    public function setCreatedDate($date)
    {
        $this->created_date = $date;
    }

    public function getCreatedDate()
    {
        return $this->created_date;
    }

    public function setModifiedDate($date)
    {
        $this->modified_date = $date;
    }

    public function getModifiedDate()
    {
        return $this->created_date;
    }
    

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {

    }

    /**
     * @Assert\IsTrue(message="Password must contain small and big letters, numbers and special characters.")
     */
    public function isPasswordValid()
    {
        $bigLetters="ÖÜÓQWERTZUIOPÕÚASDFGHJKLÉÁÛÍYXCVBNM";
        $smallLetters="öüóqwertzuiopõúasdfghjkléáûíyxcvbnm";
        $numbers="0123456789";
        $specials="_.,;?*";

        for ($i=0;$i<strlen($this->password);$i++)
        {
           $current = substr ( $this->password , $i ,1 );

            if (strstr($bigLetters,$current) != false)   $bigLetters=true;
            if (strstr($smallLetters,$current) != false) $smallLetters=true;
            if (strstr($numbers,$current) != false)      $numbers=true;
            if (strstr($specials,$current) != false)     $specials=true;
        }

        return ($bigLetters === true &&
                $smallLetters === true &&
                $numbers === true &&
                $specials === true) ?true:false;
    }

}
