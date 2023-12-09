<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UploadFileRequest;
use App\Http\Requests\Api\UploadImageRequest;
use App\Http\Resources\FileResource;
use App\Traits\HasAttachment;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    use ResponseTrait,HasAttachment;

    public function uploadImage(UploadImageRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = self::saveImageResize($request->image,'images',$request->title);
         return self::successResponse(__('application.uploaded'),FileResource::make($file));
    }

    public function uploadImageNoResize(UploadImageRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = self::saveImageWithoutResize($request->image,'images',$request->title);
         return self::successResponse(__('application.uploaded'),FileResource::make($file));
    }

    public function uploadAttachment(UploadFileRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = self::saveFile($request->file,'files',$request->title,$request->size);
         return self::successResponse(__('application.uploaded'),FileResource::make($file));
    }
}
