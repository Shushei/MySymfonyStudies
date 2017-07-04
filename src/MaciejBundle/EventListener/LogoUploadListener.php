<?php

namespace MaciejBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use MaciejBundle\Entity\Games;
use MaciejBundle\Entity\Companies;
use MaciejBundle\Entity\GameImage;
use MaciejBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


class LogoUploadListener
{

    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
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
        if ($entity instanceof Games && $file = $entity->getLogo() instanceof UploadedFile) {
            $this->uploader->setVar('games');
            $file = $entity->getLogo();
            $fileName = $this->uploader->upload($file);
            $entity->setLogo($fileName);
        }
        if ($entity instanceof Companies && $file = $entity->getClogo() instanceof UploadedFile) {
            $this->uploader->setVar('companies');
            $file = $entity->getClogo();
            $fileName = $this->uploader->upload($file);
            $entity->setClogo($fileName);
        }
        if ($entity instanceof GameImage && $file = $entity->getGameimage() instanceof UploadedFile) {
            $this->uploader->setVar('gameimage');
            $file = $entity->getGameimage();
            $fileName = $this->uploader->upload($file);
            $entity->setGameimage($fileName);
        }

        return;
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Games && $fileName = $entity->getLogo()) {
            $this->uploader->setVar('games');
            $entity->setLogo(new File($this->uploader->getTargetDir() . '/' . $fileName));
        }
        if ($entity instanceof Companies && $fileName = $entity->getClogo()) {
            $this->uploader->setVar('companies');
            $entity->setClogo(new File($this->uploader->getTargetDirCompany() . '/' . $fileName));
        }
        if ($entity instanceof GameImage && $fileName = $entity->getGameimage()) {
            $this->uploader->setVar('gameimage');
            $entity->setGameimage(new File($this->uploader->getTargetDirGameImage() . '/' . $fileName));
        }
            return;
                
            
        }
    }
    