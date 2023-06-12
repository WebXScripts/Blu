<?php

namespace App\Query\Implements;

use App\Models\Website;
use App\Query\BaseQuery;

class ScanHistoryQuery extends BaseQuery
{
    public function __construct(Website $model)
    {
        parent::__construct($model);
    }

    public function byWebsiteId(int $id): self
    {
        $this->query->where('website_id', $id);
        return $this;
    }
}
