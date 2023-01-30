<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    public function show(){
        return view('Add-category');
    }
    public function AddCategory(Request $req){
        $req->validate([
            'cat_name'=>'required',
        ]);
        $category = new category;
        $category->cat_name = $req->cat_name;
        $result = $category->save();
        if($result){
            $msg = 'Data Added';
        }else{
            $msg = 'Data Addition Failed';
        }
        echo json_encode(array('msg'=>$msg));
    }
    public function ViewCategories(){
        $categories = category::all();
        if($categories->count()>0){
            foreach($categories as $c){
                $TableData[]=array($c->cat_id,$c->cat_name,
                "<button data-id='".$c->cat_id."' id='del_cat'>X</button>");
            }
            $response = array();
            $response['success'] = true;
            $response['aaData'] =$TableData;
            echo json_encode($response);
        }else{
        $response = array();
        $response['sEcho'] = 0;
        $response['iTotalRecords'] = 0;
        $response['iTotalDisplayRecords'] = 0;
        $response['aaData'] = [];
        echo json_encode($response);
        }
    }
    public function DelCategories(Request $req){
$categories = category::find($req->cat_id);
 $result = $categories->delete();
if($result){
    $msg = "deleted";
}
    }
}
