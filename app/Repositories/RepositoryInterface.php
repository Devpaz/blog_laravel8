<?php
namespace App\Repositories;

interface RepositoryInterface {
    public function paginated();
    public function create();
    public function update(int $id);
    public function delete(int $id);
    public function find(int $id);
}
