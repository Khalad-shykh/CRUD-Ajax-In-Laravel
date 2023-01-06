<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductsController extends Controller
{
    public function show()
    {
        return view('Add-products');
        
    }
    
    public function CreateProducts(Request $req)
    {
        $product = new product;
        $product->p_name = $req->p_name;
        $product->p_price = $req->p_price;
        $product->p_quantity = $req->p_quantity;
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
                    <button class="btn-sm btn-primary" id="update_btn"  data-toggle="modal"   data-target="#Update_Modal" data-id="'.$p->id.'">update</button>|<button class="btn-sm btn-danger" id="delete" data-id="'.$p->id.'">X</button>'
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
    public function LoadModal(Request $req)
    {
        $product = product::find($req->id);
        if($product->count()>0)
        {
            $Modal = '
                        <div class="form-group">
                          <input type="text" class="form-control" value="'.$product->p_name.'" name="" id="u_p_name" aria-describedby="helpId" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="" value="'.$product->p_price.'" id="u_p_price" aria-describedby="helpId" placeholder="Enter Product Price">
                          </div>
                          <div class="form-group">
                            <input type="number" class="form-control" name="" value="'.$product->p_quantity.'" id="u_p_quantity" aria-describedby="helpId" placeholder="Enter Product Quantity">
                          </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" id="save" data-id="'.$product->id.'" >Save</button>
                          </div>
                      </div>
                  </div>';
        }
        echo json_encode(array('Modal'=>$Modal));
    }
    public function UpdateProducts(Request $req){

        // echo $req->id.$req->u_p_name.$req->u_p_price.$req->u_p_quantity;
        $product = product::find($req->id);
        $product->p_name = $req->u_p_name;
        $product->p_price = $req->u_p_price;
        $product->p_quantity = $req->u_p_quantity;
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
