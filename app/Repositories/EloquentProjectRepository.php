<?php
namespace App\Repositories;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentProjectRepository implements ProjectRepositoryInterface {

    public function paginated()
    {
        return ProjectResource::collection(Project::with(["user"])
            ->orderByDesc("id")
            ->paginate(5)
        );
    }

    public function create()
    {
        return Project::create(request()->only("name", "description"));
    }

    public function update(int $id)
    {
        return Project::where('id', $id)
            ->update(request()->only("name", "description"));
    }

    public function delete(int $id)
    {
        return Project::destroy($id);
    }

    public function find(int $id)
    {
        if (null == $project = Project::find($id)) {
            throw new ModelNotFoundException("Proyecto no encontrado");
        }
        return new ProjectResource($project);
    }
}
