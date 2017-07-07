<?php

namespace MaciejBundle\Service;

use Aws\S3\S3Client;
Use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderAWS
{

    private $client;
    private $bucket;

    public function setClient($client)
    {
        return $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function __contruct($bucket, array $S3arguments)
    {
        $this->setBucket($bucket);
        // Ten setClient nie działa, chciałbym żeby to się działo w construktorze
        $this->setClient(new S3Client($S3arguments));
    }

    public function upload(UploadedFile $file)
    {
        $this->setClient(new S3Client(array(
            'credentials' => array(
                'key' => 'AKIAI6NGJLAK7QK2UEVQ',
                'secret' => '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',),
            'region' => 'us-east-1',
            'version' => 'latest'
        )));
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        if ($this->bucket == 'games') {
            $this->getClient()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->bucket,
                'key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        if ($this->bucket == 'companies') {
            $this->getClient()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->bucket,
                'key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        if ($this->bucket == 'gameimage') {

            $this->getClient()->putObject(array(
                'Bucket' => 'maciej' . '.' . $this->bucket,
                'Key' => $fileName,
                'SourceFile' => $file,
                'ACL' => 'public-read'
            ));
        }
        return $fileName;
    }

    public function listing()
    {
        $this->setClient(new S3Client(array(
            'credentials' => array(
                'key' => 'AKIAI6NGJLAK7QK2UEVQ',
                'secret' => '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',),
            'region' => 'us-east-1',
            'version' => 'latest'
        )));
        $client = $this->getClient();
        $iterator = $client->listObjects(array(
            'Bucket' => 'maciej' . '.' . $this->bucket,
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

    public function setBucket($bucket)
    {
        return $this->bucket = $bucket;
    }

    public function getBucket()
    {
        return $this->bucket;
    }

}
