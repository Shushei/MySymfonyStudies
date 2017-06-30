<?php

namespace MaciejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Games
{

    public function __construct()
    {
        $this->title = 'Set Title';
        $this->company = 'Set Company';
        $this->releaseDate = new \DateTime('yesterday');
    }

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
     * @ORM\ManyToOne(targetEntity="Companies", inversedBy="games")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;
/**
 *@ORM\Column(type="string")
 * @assert\NotBlank(message="Please, upload logo.")
 * @Assert\File
 * 
 */
   private $logo;
   
   public function getLogo()
   {
       return $this->logo;
       
   }
   public function setLogo($logo)
   {
       $this->logo = $logo;
       return $this;
   }
   
   

    /**
     *  @ORM\Column(type="date")
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
