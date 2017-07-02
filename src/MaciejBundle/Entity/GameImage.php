<?php
namespace MaciejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="gameimage")
 */

class GameImage 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Games", inversedBy="images")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    protected $game;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\File
     * 
     */
    private $gameimage;
    
    public function getId()
    {
        return $this->id;
    }
    public function setGame($game)
    {
       return $this->game = $game;
       
    }
    public function getGame()
    {
        return $this->game;
    }
    public function setGameimage($gameimage)
    {
        return $this->gameimage = $gameimage;
    }
    public function getGameimage()
    {
        return $this->gameimage;
    }
}
