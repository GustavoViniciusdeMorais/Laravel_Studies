<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Api\Domains\Account\Infrastructure\Repositories\TransactionEloquentRepository;
use Api\Domains\Account\Actions\RegisterTransactionAction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $action = new RegisterTransactionAction(new TransactionEloquentRepository());
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
