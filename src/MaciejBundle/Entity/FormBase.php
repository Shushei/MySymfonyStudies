<?php


namespace MaciejBundle\Entity;


class FormBase 
{
    protected $title;
    protected $company;
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
}
