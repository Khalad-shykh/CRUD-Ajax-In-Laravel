<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
class ProductsController extends Controller
{
    public function show()
    {
        $categories = category::all();
        return view('Add-products')->with('categories',$categories);
        
    }
    
    public function CreateProducts(Request $req)
    {
        $product = new product;
        $product->p_name = $req->p_name;
        $product->p_price = $req->p_price;
        $product->p_quantity = $req->p_quantity;
        $product->cat_id = $req->c_id;
        $result = $product->save();
        if($result)
        {
            $msg = "Success";
        }
        else
        {
            $msg = "Failed";
        }
        echo json_encode(array('msg'=>$msg));
    }
    public function ViewProducts()
    {
        $products = product::all();
        if($products->count()>0)
        {
            foreach($products as $p)
            {
                $TableData[] = array(
                    $p->p_name,$p->p_price,$p->p_quantity,'
                    <button class="btn-sm btn-primary" id="update_btn"  data-toggle="modal" data-id="'.$p->id.'">update</button>|<button class="btn-sm btn-danger" id="delete" data-id="'.$p->id.'">X</button>'
                );
            }
            $response = array();
            $response['success'] = true;
            $response['aaData'] = $TableData;
            echo json_encode($response);
        }
        else{
            
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }
    public function GetValues(Request $req)
    {
         $product = product::find($req->id);
         if($product->count()>0)
         {
            echo json_encode(array("p_id"=>$product->id,"p_name"=>$product->p_name,"p_price"=>$product->p_price,"p_quantity"=>$product->p_quantity,"cat_id"=>$product->cat_id));
        }
        
    }
    public function UpdateProducts(Request $req){

        // echo $req->id.$req->u_p_name.$req->u_p_price.$req->u_p_quantity;
        $product = product::find($req->id);
        $product->p_name = $req->u_p_name;
        $product->p_price = $req->u_p_price;
        $product->p_quantity = $req->u_p_quantity;
        $product->cat_id = $req->c_id;
        $result = $product->save();
        if($result)
        {
            $msg = "Success";
        }
        else
        {
            $msg = "Failed";
        }
        echo json_encode(array('msg'=>$msg));
    }
    
    public function DeleteProducts(Request $req){
        $product = product::find($req->id);
        $result = $product->delete();
        if($result){
            $msg = 'success';
        }
        else{
            $msg = 'failed';
        }
        echo json_encode(array('msg'=>$msg));
    }
}
