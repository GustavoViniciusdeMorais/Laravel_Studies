<?php

namespace Modules\Builder\Actions;

class GustavoPackageBuilderAction
{

    public function execute()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'ok'
        ]);
    }
}
