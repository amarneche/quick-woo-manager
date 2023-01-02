<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function upload(Request $request){
        // upload that file into a temporary folder
        $filesArray=$request->file();
        if(is_array($filesArray)){
            
                //check either it's an arry or just one file .
                if(is_array($filesArray[array_key_first($filesArray)])){
                    $item=$filesArray[array_key_first($filesArray)];
                    
                    $filePath=  $item[array_key_first($item)]->store('public/temp'); 

                }else {
                    $filePath=  $request->file()[array_key_first($request->file())]->store('public/temp'); 

                }
                
                return $filePath;
            

        }
        return response(status:400);
       
    }
    public function ckUpload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            $request->file('upload')->move(public_path('media'), $fileName);
    
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}