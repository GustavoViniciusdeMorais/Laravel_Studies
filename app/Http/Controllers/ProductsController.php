<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index')->withProducts($products);
    }

    public function listarProdutos()
    {
        $products = Product::with('comments')->get();
        return response()->json($products);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        try{
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            if($product->save()){
                //return response()->json($product);
                return redirect()->route('product.index');
            }else{
                return response()->json('Erro ao salvar produto');
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')->withProduct($product);
    }

    public function alterar($id, Request $request)
    {
        try{
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            if($product->save()){
                //return response()->json($product);
                return redirect()->route('product.index');
            }else{
                return response()->json('Erro ao editar produto');
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            if($product->delete()){
                //return response()->json($product);
                return redirect()->route('product.index');
            }else{
                return response()->json('Erro ao deletar o produto!');
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

}
