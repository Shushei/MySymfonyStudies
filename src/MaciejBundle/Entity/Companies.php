<?php

namespace MaciejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Companies")
 * @UniqueEntity("company")
 */
class Companies
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    protected $company;
    /**
     *@ORM\OneToMany(targetEntity="Games", mappedBy="company")
     */
    private $games;
    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTime")
     * @Assert\NotBlank()
     */
    protected $founded;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $ownername;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $ownersurname;

    public function getId()
    {
        return $this->id;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        return $this->company = $company;
    }

    public function getFounded()
    {
        return $this->founded;
    }

    public function setFounded($founded)
    {
        return $this->founded = $founded;
    }

    public function getOwnername()
    {
        return $this->ownername;
    }

    public function setOwnername($ownername)
    {
        return $this->ownername = $ownername;
    }

    public function getOwnersurname()
    {
        return $this->ownersurname;
    }

    public function setOwnersurname($ownersurname)
    {
        return $this->ownersurname = $ownersurname;
    }

}
