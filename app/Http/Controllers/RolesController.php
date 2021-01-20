<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Permission;
use DB;
use App\Role;
class RolesController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
       
    }



    public function readrole()
    {  
        
        
          $data= Role::get();
         return response()->json($data); 
       
    }



    public function readroleonly()
    {  
        
        
          $data= Role::where('name','Admin')->orWhere('name','Report Manager')->get();
         return response()->json($data); 
       
    }
   
    public function index(Request $request)
    {
           $role=Role::all();
        return view('roles.index', compact('role'));
    }

    
    public function create()
    {
        
        return view('roles.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            
            'name'=>'required',
            
        ]);
      $role=new Role([
            'name' => $request->get('name'),
            
        
        
        ]);
        $role->save();
        return redirect('roles');
    }
       




       

    
    
    public function edit($id)
    {


        abort_unless(\Gate::allows('isAdmin'), 403);
        $role = Role::find($id);
        return view('role.edit', compact('role'));   
        
    }

   
    public function update(Request $request,  $id)
    {



        abort_unless(\Gate::allows('isAdmin'), 403);
        $validatedData = $request->validate([
            'name'=>'required'
            
        ]);
        
        $role = Role::find($id);
        $role->name=  $request->get('name');
       
        $book->save();
        return redirect('/roles');
        
    }

    
    public function destroy($id )
    {
        $role = Role::find($id);

        if ($role)  {
            if ($role->delete()){
    
            DB::statement('ALTER TABLE roles AUTO_INCREMENT = '.(count(Role::all())+1).';');
            }
            return redirect('/roles');
    }
}
}