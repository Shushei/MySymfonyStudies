<?php

namespace MaciejBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;

class FileUploader
{

    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->targetDir, $fileName);
        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function delete($fileName)
    {
        $file = new File($fileName);
        $filedelete = new Filesystem();
        $filedelete->remove($file);
                
    }

}
