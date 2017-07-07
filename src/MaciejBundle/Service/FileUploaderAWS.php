<?php
namespace MaciejBundle\Service;

use Aws\S3\S3Client;
Use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderAWS
{

private $client;
private $bucket;
public function __contruct($bucket)
{
    $this->setBuckeet($bucket);
    $this->setClient(new S3Client(array(
        'key' => 'AKIAI6NGJLAK7QK2UEVQ',
        'secret' => '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'
    )));
}
 public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        if ($this->bucket == 'games') {
            $this->getClient()->putObject(array(
                'Bucket' => 'maciej'.'.'.$this->bucket,
                'key' => $fileName,
                'SourceFile' => $file
            ));
        }
        if ($this->bucket == 'companies') {
           $this->getClient()->putObject(array(
                'Bucket' => 'maciej'.'.'.$this->bucket,
                'key' => $fileName,
                'SourceFile' => $file
                   ));
        }
        if ($this->bucket == 'gameimage') {
           $this->getClient()->putObject(array(
                'Bucket' => 'maciej'.'.'.$this->bucket,
                'key' => $fileName,
                'SourceFile' => $file
                   ));
        }
        return $fileName;
    }
public function setBucket($bucket)
{
    return $this->bucket = $bucket;
}
public function getBucket()
{
    return $this->bucket;
}
}



