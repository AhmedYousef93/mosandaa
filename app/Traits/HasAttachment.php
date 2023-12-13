<?php

namespace App\Traits;

use App\Models\Attachment;
use App\Models\User;
//use App\Services\AttachmentService;
use App\Services\AttachmentService;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;

trait HasAttachment
{
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function saveImageResize(
        UploadedFile $file,
        string $folder,
        string $title,
        int $id = null
    ): Attachment|\Illuminate\Database\Eloquent\Model {
        if ($id != null) {

            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new \App\Services\AttachmentService)->image_uploader_with_resize($file, $folder, $attach->file)
            ]);

            return $attach;
        } else

            return Attachment::create([
                'type' => 1,
                'title' => $title,
                'file' => (new \App\Services\AttachmentService)->image_uploader_with_resize($file, $folder),
            ]);
    }

    public function saveImageWithoutResize(
        UploadedFile $file,
        string $folder,
        string $title,
        int $id = null
    ): Attachment|\Illuminate\Database\Eloquent\Model {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new \App\Services\AttachmentService)->image_uploader_without_resize($file, $folder, $attach->file)
            ]);
            return $attach;
        } else
            return Attachment::create([
                'type' => 1,
                'title' => $title,
                'file' => (new \App\Services\AttachmentService)->image_uploader_without_resize($file, $folder),
            ]);
    }

    public function saveFile(
        UploadedFile $file,
        string $folder,
        string $title,
        $size = null,
        int $id = null
    ): Attachment|\Illuminate\Database\Eloquent\Model {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new \App\Services\AttachmentService)->file_uploader($file, $folder, $attach->file)
            ]);
            return $attach;
        } else
            return Attachment::create([
                'type' => $title == "video" || "audio" ? 3 : 2,
                'title' => $title,
                'size' => $size ?? 0,
                'file' => (new \App\Services\AttachmentService)->file_uploader($file, $folder),
            ]);
    }


    public function assignAttachment(array $files): void
    {
        if ($this->attachments()) {
            $this->attachments()->update(['attachmentable_type' => null, 'attachmentable_id' => null]);
        }

        Attachment::whereIn('id', $files)->update([
            'attachmentable_type' => get_class($this),
            'attachmentable_id' => $this->id,
        ]);
        Attachment::where('attachmentable_type', null)->delete();
    }

    public function deleteAllAttachments(string $path): void
    {
        foreach ($this->attachments as $key => $file) {
            (new \App\Services\AttachmentService)->deleteFile($path, $file->file);
            $file->delete();
        }
    }

    public function getAllFiles(string $path): array
    {
        $files = [];
        foreach ($this->attachments as $file) {
            $files[] = [
                'src' => asset('uploads/' . $path . '/' . $file->file),
                'file' => $file,
            ];
        }
        return $files;
    }

    public function saveImageAndAssign(UploadedFile $file, string $title, string $folder = 'images', int $id = null): void
    {
        $attachment = $this->saveImageResize($file, $folder, $title, $id);
        $attachment->update([
            'attachmentable_type' => get_class($this),
            'attachmentable_id' => $this->id,
        ]);
    }

    public function saveImagesAndAssign(array $files, string $title, string $folder = 'images'): void
    {
        foreach ($files as $file) {
            $this->saveImageAndAssign($file, $title, $folder);
        }
    }

    public function saveFileAndAssign(UploadedFile $file, string $title, string $folder = 'files', int $id = null): void
    {

        $attachment = $this->saveFile($file, $folder, $title, $id);
        $attachment->update([
            'attachmentable_type' => get_class($this),
            'attachmentable_id' => $this->id,
        ]);
    }
}
