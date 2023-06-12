<?php

namespace App\Query;

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
}
