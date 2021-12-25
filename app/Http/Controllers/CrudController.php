<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

abstract class CrudController extends Controller
{
    protected RepositoryInterface $repository;

    /**
     * p. ej.: projects
     * @var string
     */
    protected string $resource;

    /**
     * p. ej.: ProjectRequest::class
     * @var string
     */
    protected string $formRequest;

    /**
     * @var string
     * p. ej.: Proyecto creado
     */
    protected string $messageStore;

    /**
     * @var string
     * p. ej.: Proyecto actualizado
     */
    protected string $messageUpdate;

    /**
     * @var string
     * p. ej.: Proyecto eliminado
     */
    protected string $messageDestroy;

    abstract protected function formCreateMetaData(): array;
    abstract protected function formUpdateMetaData(): array;

    public function index(): View {
        return view($this->resource . ".index")->with([
            $this->resource => $this->repository->paginated()
        ]);
    }

    public function create(): View {
        $metaData = $this->formCreateMetaData();
        return view($this->resource . ".create", $metaData);
    }

    public function store(): RedirectResponse {
        app($this->formRequest);
        $this->repository->create();
        return redirect()->route($this->resource . '.index')
            ->with('success', __($this->messageStore));
    }

    public function edit(): View {
        $metaData = $this->formUpdateMetaData();
        return view($this->resource . ".edit", $metaData);
    }

    public function update(int $id): RedirectResponse {
        app($this->formRequest);
        $this->repository->update($id);
        return redirect()->route($this->resource . '.index')
            ->with('success', __($this->messageUpdate));
    }

    public function destroy(int $id): RedirectResponse {
        $this->repository->delete($id);
        return redirect()->route($this->resource . '.index')
            ->with('success', __($this->messageDestroy));
    }
}
