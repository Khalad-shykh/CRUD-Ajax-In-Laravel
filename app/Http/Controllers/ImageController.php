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
            ['img' => 'required|image|mimes:png,jpg']
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
}
