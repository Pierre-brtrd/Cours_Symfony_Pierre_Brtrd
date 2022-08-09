<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test-image')]
    public function test()
    {
        $files = glob(realpath(dirname(__DIR__).'/DataFixtures/images').'/*.*');

        $file = array_rand($files);

        $imageName = substr(strrchr($files[$file], '/'), 1);
        // dd($files[$file], $imageName);

        $imageFile = new UploadedFile($files[$file], $imageName);
    }
}
