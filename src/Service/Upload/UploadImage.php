<?php


namespace App\Service\Upload;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadImage
{
    /**
     * @var SluggerInterface
     */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function saveImage($uploadedFile, $backupDirectory)
    {
        $originalImageName= pathinfo($uploadedFile->getClientOriginalName(),PATHINFO_FILENAME);
        $safeFileName = $this->slugger->slug($originalImageName);
        $newFileName = $safeFileName.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        try{
            $uploadedFile->move(
                $backupDirectory,
                $newFileName
            );
        }catch(FileException $e){
            throw new \Exception('Le fichier n\a pas pus être enregistrer.');
        }
        return $newFileName;
    }
}