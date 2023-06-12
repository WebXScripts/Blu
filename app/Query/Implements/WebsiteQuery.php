<?php

namespace App\Query\Implements;

use App\Models\Website;
use App\Query\BaseQuery;

class WebsiteQuery extends BaseQuery
{
    public function __construct(Website $model)
    {
        parent::__construct($model);
    }

    public function byId(int $id): self
    {
        $this->query->where('id', $id);
        return $this;
    }

    public function byUUID(string $uuid): self
    {
        $this->query->where('uuid', $uuid);
        return $this;
    }
}
