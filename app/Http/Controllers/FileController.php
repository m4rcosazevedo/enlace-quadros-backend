<?php

namespace App\Http\Controllers;


use App\Filters\FileFilter;
use App\Http\Requests\FileRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\StorageService;

class FileController extends Controller
{

    protected File $file;
    protected StorageService $storage_service;
    protected string $file_path;

    public function __construct(File $file, StorageService $storage_service)
    {
        $this->file = $file;
        $this->storage_service = $storage_service;
        $this->file_path = "files/";
    }

    /**
     * @param FileFilter $filter
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FileFilter $filter)
    {
        $files = FileResource::collection(
            $this->paginate($this->file->filter($filter)->orderDesc())
        );

        return view('file.index', compact('files'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('file.form');
    }


    /**
     * @param FileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request)
    {
        try {
            $this->file->create([
                "filename" => $this->storage_service->save($this->file_path, $request->filename),
                "description" => $request->description
            ]);
            flash('Arquivo criado com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar o arquivo.')->error();
        }

        return redirect()->route('file.index');
    }

    public function edit(int $id)
    {
        $file = $this->file->findOrFail($id);

        return view('file.form',  compact('file'));
    }

    public function update(FileUpdateRequest $request, int $id) {
        $data = $request->only("filename", "description");

        try {
            $file = $this->file->findOrFail($id);

            if ($request->filename) {
                $this->storage_service->delete($this->file_path, $file->filename);
                $data['filename'] = $this->storage_service->save($this->file_path, $request->filename);
            }

            $file->update($data);

            flash('Arquivo atualizada com sucesso.')->success();

            return redirect()->route('file.edit', $file->id);
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar a arquivo.')->error();

            return redirect()->route('file.index');
        }
    }

    public function destroy(int $id) {
        try {
            $file = $this->file->findOrFail($id);

            $this->storage_service->delete($this->file_path, $file->filename);
            $file->delete();
            flash('Arquivo excluída com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao excluir o arquivo.')->error();
        }
        return redirect()->route('file.index');
    }
}
