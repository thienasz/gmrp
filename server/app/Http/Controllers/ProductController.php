<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\ProductImages;
use App\Models\Products;
use App\Services\ProductsService;
use App\Transformers\ProductImageTransformer;
use Illuminate\Http\Request;
use App\Transformers\ShowProductTransformer;
use App\Transformers\ProductTransformer;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProductController extends Controller
{
    private $productsService, $products, $productImages, $likeModel;

    public function __construct(ProductsService $productsService,
                                Products $products,
                                ProductImages $productImages,
                                Like $likeModel)
    {
        $this->productsService = $productsService;
        $this->products = $products;
        $this->productImages = $productImages;
        $this->likeModel = $likeModel;
    }

    public function getAllProducts($categoryID){
        $products = $this->productsService->getProductsByCategory($categoryID);
        return response()->collection($products, new ShowProductTransformer());
    }

    public function getProduct($productID){
        //Increase views
        $a = $this->productsService->increaseView($productID);

        $products = $this->productsService->getProduct($productID);
        return response()->item($products, new ProductTransformer());
    }

    public function getHotProduct(){
        $hotProduct = $this->products->getAllHotProduct();

        return response()->collection($hotProduct, new ShowProductTransformer());
    }

    public function searchByKeyword(Request $request){
        $result = $this->products->searchByKeyword($request);
        return response()->collection($result, new ShowProductTransformer());
    }

    public function getImages($productID){
        $productImages = $this->productImages->getAllProductImages($productID);

        return response()->collection($productImages, new ProductImageTransformer());
    }

    public function getLikedProduct(){
        $user = Auth::user();
        $likedProducts = $this->likeModel->getLikedProduct($user->id);

        if (!$likedProducts){
            return response()->json(["Message"=>"You haven't liked any product."]);
        }else{
            $products = $this->products->getLikedProduct($likedProducts);

            return response()->collection($products, new ShowProductTransformer());
        }
    }

    public function store(Request $request){

        //Validation
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|min:3|unique:Products',
            'quantity' => 'required|integer',
            'price' => 'integer',
            'categoryID' => 'required|integer',
            'avatar' => 'required'
        ]);

        if ($validate->fails())
            return response()->json(["Error"=>$validate->errors()]);

        //Create new product with images
        $productCreated = $this->productsService->createProduct($request);

        if ($productCreated){
            return response()->json(["data"=>$productCreated]);
        }else{
            return response()->json(["Message"=>"Error creating new product."]);
        }
    }

    public function update(Request $request, $productID){
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|min:3',
            'quantity' => 'required|integer',
            'price' => 'integer',
            'categoryID' => 'required|integer',
            'avatar' => 'required',
            'status' => 'required'
        ]);
        if ($validate->fails())
            return response()->json(["Error"=>$validate->errors()]);

        //Delete old avatar image
        //Save avatar name and product name to process
        $avatar_name = $this->productsService->getAvatarName($productID);

        //Update product in database
        $updateProduct = $this->productsService->updateProduct($request,$productID);

        if (!$updateProduct)
            return response()->json(["Error"=>"Failed to update product."]);

        if (file_exists(public_path().'\storage\product\\'.$avatar_name))
            $delete = $this->productsService->deleteOldImage($avatar_name);

        if (!$delete)
            return response()->json(["Error"=>"Failed to delete avatar image in directory."]);

        $new_product = $this->productsService->getProduct($productID);
        return response()->item($new_product, new ProductTransformer());
    }

    public function delete($productID){
        //Check if product exits
        $product = $this->productsService->getProduct($productID);
        if (!$product)
            return response()->json(["Message"=>"Item is null"]);

        $delete = $this->productsService->deleteProduct($productID);

        if (!$delete)
            return response()->json(["Error"=>"Failed to delete product."]);

        return response()->json(["Message"=>"Delete Successfully!"],200);
    }
}
