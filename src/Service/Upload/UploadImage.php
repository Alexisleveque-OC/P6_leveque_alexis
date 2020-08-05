<?php


namespace App\Service\Upload;

use App\Entity\Image;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @var SaveImage
     */
    private $saveImage;

    /**
     * UploadImage constructor.
     * @param SluggerInterface $slugger
     * @param string $imageDirectory
     * @param SaveImage $saveImage
     */
    public function __construct(SluggerInterface $slugger, string $imageDirectory,SaveImage $saveImage)
    {
        $this->slugger = $slugger;
        $this->imageDirectory = $imageDirectory;
        $this->saveImage = $saveImage;
    }

    public function saveImageInServer(Image $image): Image
    {
        if ($image->getFile() instanceof UploadedFile) {
            $uploadedFile = $image->getFile();
            $originalImageName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFileName = $this->slugger->slug($originalImageName);
            $newFileName = $safeFileName . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
            try {
                $uploadedFile->move(
                    $this->imageDirectory,
                    $newFileName
                );
            } catch (FileException $e) {
                throw new Exception('Le fichier n\a pas pus être enregistrer.');
            }
            if($image->getFileName() != $newFileName && $image->getFileName() != null)
            {
                $this->saveImage->deleteImageInServer($image);
            }
            $image->setFileName($newFileName);
        }
        return $image;

    }
}