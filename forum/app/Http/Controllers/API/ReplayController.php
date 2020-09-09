<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ReplayResource;
use App\Replay;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
use App\Notifications\ReplyAdded;

class ReplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
        $v=Validator::make($request->all(),[
          "content"=>"required"

        ]);
        if($v->fails())
        {
          return response()->json(["error"=>true,"errors"=>$v->errors()],422);
        }
        $replay=new Replay([
          "content"=>$request->content,
          "user_id"=>$request->user_id,
          "discussion_id"=>$request->discussion_id
        ]);
        $replay->save();
        $replay->discussion->user->notify(new ReplyAdded($replay));//the user class use the notify trait
        return new ReplayResource($replay);
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
