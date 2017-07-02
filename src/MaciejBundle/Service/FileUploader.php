<?php

namespace MaciejBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;

class FileUploader
{

    private $targetDir;
    private $targetDirCompany;
    public $var;

    public function setVar($var)
    {
        $this->var = $var;
    }

    public function __construct($targetDir, $targetDirCompany)
    {
        $this->targetDir = $targetDir;
        $this->targetDirCompany = $targetDirCompany;
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

    public function delete($fileName)
    {
        $file = new File($fileName);
        $filedelete = new Filesystem();
        $filedelete->remove($file);
    }

}
