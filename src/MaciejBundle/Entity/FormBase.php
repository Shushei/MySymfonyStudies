<?php


namespace MaciejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
     * @ORM\Entity
     * @ORM\Table(name="game")
     */
class FormBase 
{
    /**
     * @ORM\Column( type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $title;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $company;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $releaseDate;
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {     
     $this->title = $title;  
    }
    
    public function getCompany()
    {
        return $this->company;
    }
    
    public function setCompany($company)
    {
        $this->company = $company;
    }
    
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }
    
    public function setReleaseDate(\DateTime $releaseDate = null) 
    {
        $this->releaseDate = $releaseDate;
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
}
