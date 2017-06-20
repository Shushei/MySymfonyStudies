<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MaciejBundle\Entity;

/**
 * Description of FormBaseController
 *
 * @author shushei
 */
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
