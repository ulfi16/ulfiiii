<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\galeriImage;
class ImageController extends Controller
{
    public function storeImage(Request $request)
    {
        $request->validate([
            'caption'=>'required|max:255',
            'category'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg,bmp'
        ],[
            'category.required'=>'Please select a category'
        ]);

        if($request->hasFile('image')){
            
         $file=$request->file('image');

         $image_name=rand(1000,9999).time().'.'.$file->getClientOriginalExtension();
         $thumbPath=public_path('user_images/thumb');
         $resize_image=Image::make($file->getRealPath());
         $resize_image->resize(300,200,function($c){
           
         })->save($thumbPath.'/'.$image_name);

         $file->move(public_path('user_images'),$image_name);
         

        }

        galeriImage::create([
            'user_id'=>auth()->id(),
            'caption'=>$request->caption,
            'category'=>$request->category,
            'image'=>$image_name
        ]);
        
        return redirect()->back()->with('success','Image successfully uploaded.');
    }

    public function deleteImage($id){

        $image=galeriImage::findOrFail($id);
        if ($image->user_id!=auth()->id()) {
            abort(403);
        }

        $file_path=public_path('/user_images/'.$image->image);
        if(\File::exists($file_path)){
            \File::delete($file_path);
        }

        $file_thumb_path=public_path('/user_images/thumb/'.$image->image);
        if(\File::exists($file_thumb_path)){
            \File::delete($file_thumb_path);
        }

        $image->delete();

        return redirect()->back()->with('success','Image deleted successfully.');
    }
}