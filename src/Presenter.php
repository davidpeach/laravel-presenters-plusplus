<?php

namespace Davidpeach\Presentersplusplus;

abstract class Presenter
{
    protected $entity;

    /**
     * Set the current entity for the presenter
     *
     * @return void
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Call methods within this class if a preperty does not exist.
     *
     * @return void
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }
}
