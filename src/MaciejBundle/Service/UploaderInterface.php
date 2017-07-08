<?php
namespace MaciejBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;


interface UploaderInterface
{
    public function __construct($args);
    public function setVar($var);
    public function getVar();
    public function setPath($path);
    public function getPath();
    public function upload(UploadedFile $file);
    public function listing($em);
    public function delete($key);
    
    
}

