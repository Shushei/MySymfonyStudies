<?php

namespace MaciejBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;
use MaciejBundle\Service\UploaderInterface;

class FileUploader implements UploaderInterface
{

    private $path;
    public $var;

    public function __construct($args)
    {

        $this->path = $args;
    }


    public function setVar($var)
    {
        return $this->var = $var;
    }

    public function getVar()
    {
        return $this->var;
    }

    public function setPath($path)
    {
        return $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $path = $this->path;
        if ($this->var == 'games') {
            $file->move($path['logo'], $fileName);
        }
        if ($this->var == 'companies') {
            $file->move($path['company'], $fileName);
        }
        if ($this->var == 'gameimage') {
            $file->move($path['image'], $fileName);
        }
        return $fileName;
    }

    public function listing($em)
    {
        $path = $this->path;


        if ($this->var == 'games') {
            $plainURL = $em->getRepository('MaciejBundle:Games')->findAll();
        }
        if ($this->var == 'companies') {
            $plainURL = $em->getRepository('MaciejBundle:Companies')->findAll();
        }
        if ($this->var == 'gameimage') {
            $plainURL = $em->getRepository('MaciejBundle:GameImage')->findAll();
        }
        return $plainURL;
    }

    public function delete($key)
    {
        $file = new File($key);
        $filedelete = new Filesystem();
        $filedelete->remove($file);
    }

}
