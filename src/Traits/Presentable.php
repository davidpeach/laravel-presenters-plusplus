<?php

namespace Davidpeach\Presentersplusplus\Traits;

use Exception;

trait Presentable
{
    public function present()
    {

        $this->checkForSpecificPresenter();

        if (!$this->presenter) {
            throw new Exception("Please set the protected property 'presenter' on the model");
        }

        if (!class_exists($this->presenter)) {
            throw new Exception("The class path " . $this->presenter . " doesn't seem to be right.");

        }

        return new $this->presenter($this);
    }

    /**
     * Check whether or not there is a PostType-specific presenter.
     * If so, use that instead.
     *
     * @return void
     */
    private function checkForSpecificPresenter()
    {
        if (!$this->specificPresenterBase) {
            return;
        }
        $specificPreseter = $this->specificPresenterBase . $this->makeSpecificPresenterClassName();

        if (!class_exists($specificPreseter)) {
            return;
        }

        $this->presenter = $specificPreseter;
    }

    /**
     * Find the clas which has included the trait and use it
     * to form a Specific Presenter name.
     *
     * @return void
     */
    private function makeSpecificPresenterClassName()
    {
        $class = __CLASS__;
        $exploded = explode('\\', $class);
        return end($exploded) . 'Presenter';
    }
}
