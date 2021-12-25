<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;

class ProjectController extends CrudController
{
    protected string $resource = "projects";

    protected string $messageStore = "Proyecto creado!";

    protected string $messageUpdate = "Proyecto actualizado!";

    protected string $messageDestroy = "Proyecto eliminado!";

    public function __construct(ProjectRepositoryInterface $repository) {
        $this->repository = $repository;
        $this->formRequest = ProjectRequest::class;
    }

    protected function formCreateMetaData(): array {
        $project = new Project;
        $title = __("Crear proyecto");
        $textButton = __("Crear");
        $route = route("projects.store");
        return compact("title", "textButton", "route", "project");
    }

    protected function formUpdateMetaData(): array {
        $project = $this->repository->find(request()->route("project"));
        $update = true;
        $title = __("Editar proyecto");
        $textButton = __("Actualizar");
        $route = route("projects.update", ["project" => $project]);
        return compact("title", "textButton", "route", "project", "update");
    }
}
