<?php

namespace PMI\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use PMI\TestBundle\Entity\ProductOrder;


/**
 * @ORM\Entity
 * @ORM\Table(name="order_")
 */
class Order
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
     * @ORM\Column(type="string", length="255", name="first_name")
     * @Assert\NotBlank()
     * @var string $name
     * 
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="ProductOrder", mappedBy="order", cascade={"all"} , orphanRemoval=true)
     * */
    protected $po;

    protected $products;

    public function __construct()
    {
        $this->po = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    public function getProduct()
    {
        $products = new ArrayCollection();
        
        foreach($this->po as $p)
        {
            $products[] = $p->getProduct();
        }

        return $products;
    }

    public function setProduct($products)
    {
        foreach($products as $p)
        {
            $po = new ProductOrder();

            $po->setOrder($this);
            $po->setProduct($p);

            $this->addPo($po);
        }

    }

    public function getOrder()
    {
        return $this;
    }

    public function addPo($ProductOrder)
    {
        $this->po[] = $ProductOrder;
    }
    
    public function removePo($ProductOrder)
    {
        return $this->po->removeElement($ProductOrder);
    }


}