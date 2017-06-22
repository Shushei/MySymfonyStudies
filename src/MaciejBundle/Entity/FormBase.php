<?php


namespace MaciejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
     * @ORM\Entity
     * @ORM\Table(name="game")
     */
class FormBase 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    /**
     * @ORM\Column(type="string")
     */
    protected $company;
    /**
     * @ORM\Column(type="date")
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
