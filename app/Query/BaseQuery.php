<?php

namespace App\Query;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseQuery extends Builder
{
    protected $model;
    protected $query;

    public function __construct(Model $model)
    {
        parent::__construct($model::query()->getQuery());
        $this->model = $model;
        $this->query = $model::query();
    }

    public function first($columns = ['*'])
    {
        return $this->query->first($columns);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return $this->query->paginate($perPage, $columns, $pageName, $page);
    }
}
