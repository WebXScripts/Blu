<?php

namespace App\Query\Implements;

use App\Models\ScanHistory;
use App\Models\Website;
use App\Query\BaseQuery;

class ScanHistoryQuery extends BaseQuery
{
    public function __construct(ScanHistory $model)
    {
        parent::__construct($model);
    }

    public function byWebsiteId(string $id): self
    {
        $this->query->where('website_id', $id);
        return $this;
    }
}
