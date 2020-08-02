<?php


namespace App\Service\Upload;

use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadImage
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var string
     */
    private $imageDirectory;

    /**
     * UploadImage constructor.
     * @param SluggerInterface $slugger
     * @param string $imageDirectory
     */
    public function __construct(SluggerInterface $slugger, string $imageDirectory)
    {
        $this->slugger = $slugger;
        $this->imageDirectory = $imageDirectory;
    }

    public function saveImage($uploadedFile)
    {
//        $originalImageName = $uploadedFile[0]->getFileName();
//        dd($uploadedFile[0]);
//        $originalImageName= pathinfo($uploadedFile->getClientOriginalName(),PATHINFO_FILENAME);
        dump($uploadedFile);
        $safeFileName = $this->slugger->slug($uploadedFile->getFileName());
        $newFileName = $safeFileName.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        try{
            $uploadedFile->move(
                $this->imageDirectory,
                $newFileName
            );
        }catch(FileException $e){
            throw new Exception('Le fichier n\a pas pus être enregistrer.');
        }
        return $newFileName;
    }
}