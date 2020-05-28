<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Table;
use Validator;
class TableController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('data.table');
    }
    public function index()
    {
        try{
            $tables=Table::all();
             if(sizeof($tables)>0):
             return $this->sendResponse($tables->toArray(), 'Successfully retrieved');
             endif;
         }catch(\Exception $e){
             $e->getMessage();
         }
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
            $input=$request->all();
            $validator=Validator::make($input,[
                'max_number_table'=>'required',
                'max_number_chair'=>'required'
            ]);
            if($validator->fails()):
                return $this->sendError('Invalid input', $validator->errors());  
            endif;
            $table = Table::create($input);
            return $this->sendResponse($table->toArray(), 'Successfully added');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        try{
            if(sizeof($table)>0):
                return $this->sendResponse($table->toArray(),'Successfully retrieved');
            endif;
           }catch(\Exception $e){
               return $e->getMessage();
           }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        try{
            $input=$request->all();
            $validator=Validator::make($input,[
                'max_number_table'=>'required',
                'max_number_chair'=>'required'
            ]);
            if($validator->fails()):
                return $this->sendError('Invalid input', $validator->errors());  
            endif;
            if(sizeof($table)>0):
            $table->max_number_table=$input['max_number_table'];
            $table->max_number_chair=$input['max_number_chair'];
            $table->save();
            return $this->sendResponse($table->toArray(), 'Successfully updated');
            endif;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        try{
            if(sizeof($table)>0):
            $table->delete();
            return $this->sendResponse($table->toArray(), 'Successfully destroyed');
            endif;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
