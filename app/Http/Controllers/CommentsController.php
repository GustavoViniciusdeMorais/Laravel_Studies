<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comments;
use App\Models\Product;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::with('product')->get();
        //return response()->json($comments);
        return view('comments.index')->withComments($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('id','name')->get();
        return view('comments.create')->withProducts($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $comments = new Comments();
            $comments->nickname = $request->nickname;
            $comments->text = $request->text;

            Product::findOrFail($request->product_id);

            $comments->product_id = $request->product_id;

            if($comments->save()){
                //return response()->json('Comentário salvo com sucesso!');
                return redirect()->route('comment.index');
            }else{
                throw new Exception('Erro ao salvar comentário');
            }

        }catch(Exception $e){
            return [
                'msg' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comments::find($id);
        $products = Product::select('id', 'name')->get();
        return view('comments.edit')->withComment($comment)->withProducts($products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $comment = Comments::findOrFail($id);
            $comment->nickname = $request->nickname;
            $comment->text = $request->text;

            Product::findOrFail($request->product_id);

            $comment->product_id = $request->product_id;

            if($comment->save()){
                //return response()->json('Comentario editado com sucesso!');
                return redirect()->route('comment.index');
            }else{
                throw new Exception('Erro ao editar comentario!');
            }

        }catch(Exception $e){
            return [
                'msg' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        if($comment->delete()){
            //return response()->json('Comentario deletado com sucesso');
            return redirect()->route('comment.index');
        }else{
            return response()->json('Erro ao deletar comentario');
        }
    }
}
