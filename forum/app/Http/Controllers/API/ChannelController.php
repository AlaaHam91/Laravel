<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\ChannelResource;
use App\Channel;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response()->json([
        //     "error"=>false,
        //     "Channels"=>Channel::all()
        // ],200);

        return ChannelResource::collection(Channel::all());
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
            "title"=>"required|unique:channels"
        ]);
        if($v->fails())
        {
            return response()->json([
                "error"=>true,
                "error"=>$v->errors()
            ],422);
        }
        $channel=new Channel(["title"=>$request->title]);
        $channel->save();

        return new ChannelResource($channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
        return new ChannelResource($channel);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        //
        $v=Validator::make($request->all(),[
            "title"=>"required|unique:channels"
        ]);
        if($v->fails())
        {
            return response()->json([
                "error"=>true,
                "error"=>$v->errors()
            ],422);
        }

        $channel->title=$request->title;
        $channel->save();
        return new ChannelResource($channel);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
         $channel->delete();
       //  return response()->json(null,204);

       return response()->json([
        "error"=>false,
        "message"=>"The channel with id:".$channel->id ."deleted successfuly"
    ],200);
    }
}
