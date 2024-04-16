<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Api\Domains\Account\Infrastructure\Repositories\AccountEloquentRepository;
use Api\Domains\Account\Actions\GetAccountByIdAction;
use Api\Domains\Account\Actions\CreateAccountAction;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $action = new GetAccountByIdAction(new AccountEloquentRepository());
        return $action->setData($request->all())->execute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $action = new CreateAccountAction(new AccountEloquentRepository());
        return $action->setData($request->all())->execute();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
