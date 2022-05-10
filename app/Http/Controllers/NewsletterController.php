<?php

namespace App\Http\Controllers;


use App\Filters\NewsletterFilter;
use App\Http\Requests\NewsletterRequest;
use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index (NewsletterFilter $filter)
    {
        $newsletters = NewsletterResource::collection(
            $this->paginate(Newsletter::filter($filter)->orderDesc())
        );
        return view('newsletter.index', compact('newsletters'));
    }

    public function create ()
    {
        return view('newsletter.form');
    }

    public function store(NewsletterRequest $request)
    {
        $data = $request->only("name", "email", "active");
        try {
            Newsletter::create([
                "name" => $data["name"],
                "email" => $data["email"],
                "active" => $data["active"] ?? 0,
            ]);
            flash('Newsletter criada com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar a newsletter.')->error();
        }

        return redirect()->route('newsletter.index');
    }

    public function edit(int $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('newsletter.form',  compact('newsletter'));
    }

    public function update(NewsletterRequest $request, int $id) {
        $data = $request->only("name", "email", "active");

        try {
            $newsletter = Newsletter::findOrFail($id);
            $newsletter->update([
                "name" => $data["name"],
                "email" => $data["email"],
                "active" => $data["active"] ?? false,
            ]);

            flash('Newsletter atualizada com sucesso.')->success();

            return redirect()->route('newsletter.edit', $newsletter->id);
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar a newsletter.')->error();

            return redirect()->route('Newsletter.index');
        }
    }

    public function destroy(int $id) {
        try {
            $newsletter = Newsletter::findOrFail($id);
            $newsletter->delete();
            flash('Newsletter excluída com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao excluir a newsletter.')->error();
        }
        return redirect()->route('newsletter.index');
    }
}
