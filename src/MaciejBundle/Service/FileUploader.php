<?php

namespace MaciejBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;

class FileUploader
{

    private $targetDir;
    private $targetDirCompany;
    private $targetDirGameImage;
    public $var;

    public function setVar($var)
    {
        $this->var = $var;
    }

    public function __construct($targetDir, $targetDirCompany, $targetDirGameImage)
    {
        $this->targetDir = $targetDir;
        $this->targetDirCompany = $targetDirCompany;
        $this->targetDirGameImage = $targetDirGameImage;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        if ($this->var == 'games') {
            $file->move($this->targetDir, $fileName);
        }
        if ($this->var == 'companies') {
            $file->move($this->targetDirCompany, $fileName);
        }
        if ($this->var == 'gameimage') {
            $file->move($this->targetDirGameImage, $fileName);
        }
        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
    public function getTargetDirCompany()
    {
        return $this->targetDirCompany;
    }
     public function getTargetDirGameImage()
    {
        return $this->targetDirGameImage;
    }

    public function delete($fileName)
    {
        $file = new File($fileName);
        $filedelete = new Filesystem();
        $filedelete->remove($file);
    }

}
