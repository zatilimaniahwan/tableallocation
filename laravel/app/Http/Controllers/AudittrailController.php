<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Audittrail;
use Auth;
class AudittrailController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(){
        return view('audittrails.audittrail');
    }
    public function index()
    {
        try{
            $audittrail=Audittrail::orderBy('created_at','DESC')->get();
            if(sizeof($audittrail)>0):
            return $this->sendResponse($audittrail->toArray(), 'Audittrail retrieved successfully.');
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
        $data = json_decode($request->getContent(), true);
        $user=$request->user()->id;
        $audittrail=new Audittrail;
        $audittrail->user_id=$user;
        $audittrail->activity=$data;
        $audittrail->save();
        return $this->sendResponse($audittrail->toArray(), 'Data berjaya ditambah.');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
