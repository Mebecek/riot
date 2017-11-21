<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24. 7. 2017
 * Time: 14:20
 */

namespace AppBundle\Controller\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move(__DIR__ . '//../../../../../../web/uploads/images', $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}