<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Services\StorageService;
use Illuminate\Support\Facades\Log;

class FileServiceController extends Controller
{
    public File $file;
    public StorageService $storage_service;
    public string $file_path;

    public function __construct(File $file, StorageService $storage_service)
    {
        $this->file = $file;
        $this->storage_service = $storage_service;
        $this->file_path = "files/";
    }

    public function saveOrUpdate (FileRequest $request, int $id = null)
    {
        try {
            if ($id) {
                $data = $request->only("filename", "description");
                $file = $this->file->findOrFail($id);

                if ($request->filename) {
                    $this->deleteAws($file->filename);
                }

                $data['filename'] = $this->saveAws($request->filename);
                return $file->update($data);
            }

            return $this->file->create([
                "filename" => $this->saveAws($request->filename),
                "description" => $request->description
            ]);
        } catch (\Exception $error) {
            Log::error($error);
            return null;
        }
    }

    private function saveAws ($filename)
    {
        return $this->storage_service->save($this->file_path, $filename);
    }

    public function deleteAws ($filename)
    {
        try {
            $this->storage_service->delete($this->file_path, $filename);
        } catch (\Exception $error) {
            Log::error($error);
        }
    }

    public function delete(int $id) {
        try {
            $file = $this->file->findOrFail($id);

            $this->deleteAws($file->filename);
            $file->delete();
        } catch (\Exception $error) {
            Log::error($error);
        }
    }
}
