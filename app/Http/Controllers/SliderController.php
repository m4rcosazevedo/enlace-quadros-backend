<?php

namespace App\Http\Controllers;


use App\Filters\SliderFilter;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Services\StorageService;

class SliderController extends Controller
{

    protected Slider $slider;
    protected StorageService $storage_service;
    protected string $file_path;

    public function __construct(Slider $slider, StorageService $storage_service)
    {
        $this->slider = $slider;
        $this->storage_service = $storage_service;
        $this->file_path = "files/";
    }

    public function index(SliderFilter $filter)
    {
        $sliders = SliderResource::collection(
            $this->paginate($this->slider->filter($filter)->orderDesc())
        );

        return view('slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('slider.form');
    }

    public function store(SliderCreateRequest $request)
    {
        try {
            $data = $request->all();
            $data['active'] = $data['active'] ?? false;
            $data['image'] = $this->storage_service->save($this->file_path, $request->image);

            $this->slider->create($data);
            flash('Slide criado com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar o slide.')->error();
        }

        return redirect()->route('slider.index');
    }

    public function edit(int $id)
    {
        $slider = $this->slider->findOrFail($id);

        return view('slider.form',  compact('slider'));
    }

    public function update(SliderUpdateRequest $request, int $id) {
        try {
            $data = $request->all();
            $data['active'] = $data['active'] ?? false;

            $slider = $this->slider->findOrFail($id);

            if ($request->image) {
                $this->storage_service->delete($this->file_path, $slider->image);
                $data['image'] = $this->storage_service->save($this->file_path, $request->image);
            }

            $slider->update($data);

            flash('Slider atualizado com sucesso.')->success();

            return redirect()->route('slider.edit', $slider->id);
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar o slide.')->error();

            return redirect()->route('slider.index');
        }
    }

    public function destroy(int $id) {
        try {
            $slider = $this->slider->findOrFail($id);

            $this->storage_service->delete($this->file_path, $slider->image);
            $slider->delete();
            flash('Slide excluído com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao excluir o slide.')->error();
        }
        return redirect()->route('slider.index');
    }
}
