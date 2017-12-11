<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Products extends Model
{
//    private $productModel;
//
//    public function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//    }

    protected $table = 'products';

    protected $fillable = [
        'productID','product_name','short_describe','quantity','price','categoryID','views','describe',
            'rating_score','guides','avatar_url'
    ];

    public function productModel(){
        $productModel = new Products();
        return $productModel;
    }

    public function getProductByCat($categoryID){
        $products = $this->productModel()
            ->where('categoryID',$categoryID)
            ->where('status',1)
            ->get();

        return $products;
    }

    public function getProductByID($productID){
        $product = $this->productModel()->where('productID',$productID)->first();
//        dd($product);
        return $product;
    }

    public function getAllHotProduct(){
        $hotProduct = $this->productModel()
            ->where('status',1)
            ->get()
            ->sortByDesc('views')->take(12);

        return $hotProduct;
    }

    public function searchByKeyword(Request $request){
        $keyword = $request->keyword;
        $products = $this->productModel()
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        return $products;
    }

    public function increaseViews($productID,$views){
        $increase = $this->productModel()
            ->where('productID',$productID)
            ->update(['views'=>$views]);

        return $increase;
    }

    public function getLikedProduct($productIDs){
        $products = array();

        foreach ($productIDs as $item){
            $products[] = $this->productModel()
                ->where('productID',$item)
                ->first();
        }

        return $products;
    }

    public function updateProduct(Request $request, $productID){
        $updatedProduct = $this->productModel()
            ->where('productID',$productID)
            ->update([
                'product_name' => $request->product_name,
                'short_describe' => $request->short_describe,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'categoryID' => $request->categoryID,
                'avatar_url' => url('/').str_replace(
                        'public',
                        '/storage',
                        $request->file('avatar')->store('public/product')),
                'describe' => $request->describe,
                'guides' => $request->guides,
                'status' => $request->status
            ]);

        return $updatedProduct;
    }

    public function deleteProduct($productID){

        $delete = $this->productModel()->where('productID',$productID)->delete();
        return $delete;
    }

    public function createProduct(Request $request){
        $productImage = new ProductImages();

        $createProduct = $this->productModel()->create([
            'product_name' => $request->product_name,
            'short_describe' => $request->short_describe,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'categoryID' => $request->categoryID,
            'avatar_url' => url('/') . str_replace(
                    'public',
                    '/storage',
                    $request->file('avatar')->store('public/product')),
            'describe' => $request->describe,
            'guides' => $request->guides
        ]);

        foreach ($request->file('product_images') as $images) {
            $url = url('/') . str_replace(
                    'public',
                    '/storage',
                    $images->store('public/product'));
            $createImages[] = $productImage->create([
                'image_url' => $url,
                'productID' => $createProduct->id
            ]);
        }

        return $createProduct;
    }
}
