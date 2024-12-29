<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products= Product::all();
        return view('admin.products.index')->with('products',$products);
    }
    public function store(Request $request)
    {
        $product=new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->qte=$request->qte;
        //upload image
        $newname=uniqid();  
        $image= $request->file('photo');
        $newname.=".".$image->getClientOriginalExtension();
        $destinationPath='uploads';
        $image->move($destinationPath,$newname);
        $product->photo=$newname;
        //retourne vers la page products
        if($product->save()){
            return redirect()->back();
        }
        else{
            echo "erreur";

        }
    }
    public function destroy($id){
        $product=Product::find($id);
        $file_path=public_path().'/uploads/'.$product->photo;
        unlink($file_path);
        if($product->delete()){
            return redirect()->back();
        }
        else{
            echo "erreur";
        }

        
    }
    public function update(Request $request)
    {
        
        $product= Product::find($request->idproduct);
        //dd($request);
        $product->name=$request->name;
         $product->description=$request->description;
         $product->price=$request->price;
         $product->qte=$request->qte;
         if($request->file('photo')){
            //delete the ancien photo
            $file_path=public_path().'/uploads/'.$product->photo;
            unlink($file_path);
            //upload new photo

            $newname=uniqid();  
                 $image= $request->file('photo');
                $newname.=".".$image->getClientOriginalExtension();
                 $destinationPath='uploads';
                 $image->move($destinationPath,$newname);
                 $product->photo=$newname;

         }
    
    //     //retourne vers la page products
        if($product->update()){
            return redirect()->back();
        }
         else{
             echo "erreur";

    //     }
    // }
    }

}
}
