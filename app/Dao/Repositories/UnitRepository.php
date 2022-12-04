<?php

namespace App\Dao\Repositories;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Unit;

class UnitRepository extends MasterRepository implements CrudInterface
{
    public function __construct()
    {
        $this->model = empty($this->model) ? new Unit() : $this->model;
    }

    public function dataRepository()
    {
        $query = $this->model
            ->select($this->model->getSelectedField())
            ->active()->sortable()->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->fastPaginate() : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }
}