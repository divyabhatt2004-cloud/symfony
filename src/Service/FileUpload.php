<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUpload
{
    public function __construct(private readonly SluggerInterface $slugger, private readonly ParameterBagInterface $parameterBag)
    {
    }

    public function uploadFile($folderName, UploadedFile $fileName)
    {
        $originalFilename = pathinfo($fileName->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$fileName->guessExtension();

        try {
            $fileName->move($this->parameterBag->get('kernel.project_dir'). '/public/'. $folderName, $newFilename);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $newFilename;
    }

}
