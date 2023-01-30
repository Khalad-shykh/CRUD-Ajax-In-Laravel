<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\image;

class ImageController extends Controller
{
    public function show()
    {
        return view("Image-Upload");
    }
    public function Upload(Request $req)
    {
        $req->validate(
            ['img' => 'required|mimes:png,jpg']
        );
        $imageName = time().'.'.$req->img->extension();
        $image = new image;
        $image->image_path = $imageName;
        $result = $image->save();
        if($result)
        {
            $req->img->move("images",$imageName);
            $status_code = 200;
            $msg = "Image Uploaded Succfully";
        }
        else{
            $status_code = 201;
            $msg = "Image Uploaded Failed";
        }
        echo json_encode(array('status_code'=>$status_code,'msg'=>$msg));
    }

    public function ImageView(){
        $images = image::orderBy("img_id","desc")->get();
        $data = "";
        if($images->count() > 0){
             foreach($images as $item){
                $data .= '<tr>
            <td>'.$item->img_id.'</td>
            <td><img src="'. url("images/".$item->image_path).'" height="50px"></td>
            <td><button class="btn-sm btn-danger">X</button></td>
            </tr>';
            }
        }
        echo json_encode(array("data"=>$data));
    }
}
