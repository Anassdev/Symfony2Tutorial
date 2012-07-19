<?php

namespace PMI\TestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length="255")
     * @var string $firstName
     * 
     */
    protected $name;

  
    /**
     * @ORM\OneToMany(targetEntity="ProductOrder" , mappedBy="product" , cascade={"all"} , orphanRemoval=true)
     * */
    protected $po;
    

    public function __construct()
    {

    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPo()
    {
        return $this->po;
    }

    public function setPo($po)
    {
        $this->po = $po;
    }
          
    public function __toString()
    {
        return $this->name;
    }



}