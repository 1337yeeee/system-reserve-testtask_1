<?php

namespace Model;

abstract class BaseModel implements Model
{

    public function __construct(array $modelData)
    {
        foreach($modelData as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }
    }

}
