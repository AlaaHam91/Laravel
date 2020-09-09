<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class Home extends Controller
{
    //
    public function List($id=1)
    {
        $categories = Category::find($id)->childrenCategories;
        return response()->json([
            "error"=>false,
            "result"=>$categories,
         
        ],200);

    }

    public function ListAll()
    {
        $categories = Category::all()->whereNotNull('category_id');
        return response()->json([
            "error"=>false,
            "result"=>$categories
        ],200);

    }
}
