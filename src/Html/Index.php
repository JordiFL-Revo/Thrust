<?php

namespace BadChoice\Thrust\Html;

use BadChoice\Thrust\Fields\Panel;
use BadChoice\Thrust\Resource;

class Index
{
    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function getIndexFields()
    {
        return collect($this->resource->fields())->map(function($field){
            if ($field instanceof Panel) return $field->fields;
            return $field;
        })->flatten()->where('showInIndex',true);
    }

    public function show()
    {
        return view('thrust::index', [
            'resource'  => $this->resource,
            'fields'    => $this->getIndexFields(),
            'rows'      => $this->resource->rows()
        ]);
    }


}