<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::paginate(30);        
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Books();  
        $book->name =  $request->get('name');  
        $book->additionalname = $request->get('additionalname');  
        $book->response = $request->get('response');  
        $book->additionalresponse = $request->get('additionalresponse');  
        $book->publishplace = $request->get('publishplace'); 
        $book->publishhouse = $request->get('publishhouse'); 
        $book->publishyear = $request->get('publishyear'); 
        $book->tom = $request->get('tom'); 
        $book->pages = $request->get('pages');
        $book->authorsign = $request->get('authorsign');   
        $book->code = $request->get('code');
        $book->numbersk = $request->get('numbersk');        
        $book->recieptdate = $request->get('recieptdate'); 
        $book->rubric_id = $request->get('rubric'); 
        $book->cost = $request->get('cost');  
        $book->ISBN = $request->get('ISBN');  
        $book->annotation = $request->get('annotation'); 
        $book->withraw = $request->get('withraw');           
        $book->save();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Books::find($id);
        return view('books.edit',compact('book'));
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
        $book = new Books();  
        $book->name =  $request->get('name');  
        $book->additionalname = $request->get('additionalname');  
        $book->response = $request->get('response');  
        $book->additionalresponse = $request->get('additionalresponse');  
        $book->publishplace = $request->get('publishplace'); 
        $book->publishhouse = $request->get('publishhouse'); 
        $book->publishyear = $request->get('publishyear'); 
        $book->tom = $request->get('tom'); 
        $book->pages = $request->get('pages');
        $book->authorsign = $request->get('authorsign');   
        $book->code = $request->get('code');
        $book->numbersk = $request->get('numbersk');        
        $book->recieptdate = $request->get('recieptdate'); 
        $book->rubric_id = $request->get('rubric'); 
        $book->cost = $request->get('cost');  
        $book->ISBN = $request->get('ISBN');  
        $book->annotation = $request->get('annotation'); 
        $book->withraw = $request->get('withraw');           
        $book->save();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Books::find($id);  
        $book->delete();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник удален.');
    }
}
