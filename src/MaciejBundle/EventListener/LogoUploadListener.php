<?php
namespace MaciejBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use MaciejBundle\Entity\Games;
use MaciejBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class LogoUploadListener
{
    private $uploader;
    public function __construct(FileUploader $uploader)
    {
       $this->uploader = $uploader ;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    private function uploadFile($entity)
    {
        if (!$entity instanceof Games){
            return;
        }
        $file = $entity->getLogo();
        
        if (!file instanceof UploadedFile) {
            return;
        }
        $fileName = $this->uploader->upload($file);
        $entity->setLogo($fileName);
    }
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if (!$entity instanceof Games) {
            return;
        }
        if ($fileName = $entity->getBrochure()) {
            $entity->setBrochure(new File($this->uploader->getTargetDir().'/'.$fileName));
        }
    }
            
}

