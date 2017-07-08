<?php

namespace MaciejBundle\Service;

use Aws\S3\S3Client;
Use Symfony\Component\HttpFoundation\File\UploadedFile;
use MaciejBundle\Service\UploaderInterface;

class FileUploaderAWS implements UploaderInterface
{

    private $path;
    public $var;

    public function __construct($args)
    {

        // Ten setClient nie działa, chciałbym żeby to się działo w construktorze
        $this->setPath(new S3Client());
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
        $this->setPath(new S3Client(array(
            'credentials' => array(
                'key' => 'AKIAI6NGJLAK7QK2UEVQ',
                'secret' => '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',),
            'region' => 'us-east-1',
            'version' => 'latest'
        )));
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        if ($this->var == 'games') {
            $this->getPath()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->var,
                'key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        if ($this->var == 'companies') {
            $this->getPath()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->var,
                'key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        if ($this->var == 'gameimage') {

            $this->getPath()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->var,
                'Key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        return $fileName;
    }

    public function listing($em)
    {
        $this->setPath(new S3Client(array(
            'credentials' => array(
                'key' => 'AKIAI6NGJLAK7QK2UEVQ',
                'secret' => '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',),
            'region' => 'us-east-1',
            'version' => 'latest'
        )));
        $client = $this->getPath();
        $iterator = $client->listObjects(array(
            'Bucket' => 'maciej' . '.' . $this->var,
        ));
        foreach ($iterator['Contents'] as $object) {
            $key = $object['Key'];
            $plainURL[] = array('key' => $object['Key'], 'url' => $client->getObjectUrl('maciej.gameimage', $key));
        }
        return $plainURL;
    }

    public function delete($key)
    {

        $client = new S3Client(array(
            'credentials' => array(
                'key' => 'AKIAI6NGJLAK7QK2UEVQ',
                'secret' => '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',),
            'region' => 'us-east-1',
            'version' => 'latest'
        ));
        $client->deleteObject(array(
            'Bucket' => 'maciej.gameimage',
            'Key' => $key
        ));
    }

    

}
