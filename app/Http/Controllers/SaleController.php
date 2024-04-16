<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $salesAmmount = Sale::select('product_id', DB::raw('count(id) as qtd'))
                        ->groupBy('product_id')
                        ->get();

        $result[] = ['product_id', 'qtd'];

        $key = 0;
        foreach($salesAmmount as $el){
            $result[++$key] = [$el->product_id, $el->qtd];
        }
        
        return view('sale.index')->with('result', $result);
    }
}
