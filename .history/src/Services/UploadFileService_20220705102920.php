<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class UploadFileServices
{

    private RequestStack $request;
    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    public function encodeImage()
    {
        $test = $this->request->getCurrentRequest();
        $file=$test->files->all()['imageFile'];
        return stream_get_contents(fopen($file->getRealPath(), 'rb'));
    }
}