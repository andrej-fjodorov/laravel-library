<?php

namespace App\Http\Controllers;

use App\Models\Statrelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatreleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statreleases = Statrelease::paginate(30);        
        return view('statreleases.index', compact('statreleases'));
        /*$statreleases = DB::select("SELECT * FROM statrelease s
        JOIN statreleaserubric sr
        ON sr.id =s.rubric_id");*/
        return view('statreleases.index', compact('statreleases'));             
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statreleases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $request->validate([
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
        ]);*/
        $statrelease = new Statrelease();  
        $statrelease->name =  $request->get('name');  
        $statrelease->additionalname = $request->get('additionalname');  
        $statrelease->response = $request->get('response');  
        $statrelease->publishplace = $request->get('publishplace'); 
        $statrelease->publishyear = $request->get('publishyear'); 
        $statrelease->rubric_id = $request->get('rubric');  
        $statrelease->recieptdate = $request->get('recieptdate'); 
        $statrelease->cost = $request->get('cost'); 
        $statrelease->code = $request->get('code'); 
        $statrelease->authorsign = $request->get('authorsign'); 
        $statrelease->numbersk = $request->get('numbersk'); 
        $statrelease->save();  

       
        return redirect()->route('statreleases.index');
           /* ->with('success','Статистический сборник добавлен.');*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Statrelease $statrelease)
    {
        return view('statreleases.show',compact('statrelease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $statrelease = Statrelease::find($id);
        return view('statreleases.edit',compact('statrelease'));
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
        $statrelease = new Statrelease();  
        $statrelease->name =  $request->get('name');  
        $statrelease->additionalname = $request->get('additionalname');  
        $statrelease->response = $request->get('response');  
        $statrelease->publishplace = $request->get('publishplace'); 
        $statrelease->publishyear = $request->get('publishyear'); 
        $statrelease->rubric_id = $request->get('rubric');  
        $statrelease->recieptdate = $request->get('recieptdate'); 
        $statrelease->cost = $request->get('cost'); 
        $statrelease->code = $request->get('code'); 
        $statrelease->authorsign = $request->get('authorsign'); 
        $statrelease->numbersk = $request->get('numbersk'); 
        $statrelease->save();  

       
        return redirect()->route('statreleases.index');
           /* ->with('success','Статистический сборник добавлен.');*/ 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statrelease=Statrelease::find($id);  
        $statrelease->delete();  
    }
}
