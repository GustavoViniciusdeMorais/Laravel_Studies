<?php

namespace Modules\Builder;

use Modules\Builder\Actions\GustavoPackageBuilderAction;

class GustavoPackageBuilder
{

    public function check()
    {
        $action = new GustavoPackageBuilderAction();
        return $action->execute();
    }
}
