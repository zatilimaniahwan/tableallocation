<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\StatusTable;
use App\Table;
use Validator;
class StatusTableController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try{
           $statustables=StatusTable::orderBy('id','ASC')->get();
           if(sizeof($statustables)>0):
            return $this->sendResponse($statustables->toArray(), 'Successfully retrieved');
           endif;
       }catch(\Exception $e){
           $e->getMessage();
       }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $table=Table::all();    
        $data=[];
        foreach($table as $t):
            $max_table=$t->max_number_table;
            $max_chair=$t->max_number_chair;
            foreach (range(1, $max_table) as $i) :
                $x=1;
                while($x<=$max_chair){
                    $table_code="T".implode("T",[$i]);
                    $chair_code="C".implode("C",[$x]);
                    $data['table_id']=$t->id;
                    $data['table_code']=$table_code;
                    $data['chair_code']=$chair_code;
                    $data['status']=0;
                    $status_table=StatusTable::insert($data);
                    $x++;
                }
        endforeach;
        endforeach;
        }catch(\Exception $e){
            return $e->getMessage();
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
    public function edit(StatusTable $statustable)
    {
        try{
            if(sizeof($statustable)>0):
                return $this->sendResponse($statustable->toArray(),'Successfully retrieved');
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
    public function update(Request $request, StatusTable $statustable)
    {
        try{
            $input=$request->all();
            $validator=Validator::make($input,[
                'status'=>'required'
            ]);
            if($validator->fails()):
                return $this->sendError('Invalid input', $validator->errors());  
            endif;
            if(sizeof($statustable)>0):
            $statustable->table_id=$input['table_id'];
            $statustable->table_code=$input['table_code'];
            $statustable->chair_code=$input['chair_code'];
            $statustable->status=$input['status'];
            $statustable->save();
            return $this->sendResponse($statustable->toArray(), 'Successfully updated');
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
    public function destroy($id)
    {
        //
    }
}
