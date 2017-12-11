<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/14/2017
 * Time: 10:21 AM
 */

namespace App\Services;

use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsService extends Service
{
    private $productsModel, $productImagesModel;

    public function __construct(Products $productsModel, ProductImages $productImagesModel)
    {
        $this->productsModel = $productsModel;
        $this->productImagesModel = $productImagesModel;
    }

    public function getProductsByCategory($categoryID)
    {
        $products = $this->productsModel->getProductByCat($categoryID);

        return $products;
    }

    public function getProduct($productID)
    {

        $product = $this->productsModel->where('productID', $productID)->first();

        return $product;
    }

    public function increaseView($productID)
    {
        $product = $this->productsModel->getProductByID($productID);
        $viewIncreasing = ++$product->views;
        $updateViews = $this->productsModel->increaseViews($productID, $viewIncreasing);

        return $updateViews;
    }

    public function createProduct(Request $request)
    {
        $createProduct = $this->productsModel->createProduct($request);

        return $createProduct;
    }

    public function updateProduct(Request $request, $productID)
    {
        $updatedProduct = $this->productsModel->updateProduct($request, $productID);

        return $updatedProduct;
    }

    public function getAvatarName($productID)
    {
        $product = $this->productsModel->getProductByID($productID);
        $url = $product->avatar_url;

        $urlArray = explode('/', $url);

        //Get last item in array
        return $avatar_name = end($urlArray);
    }

    public function deleteOldImage( $avatarName)
    {
        $delete = unlink(public_path('storage\product\\' . $avatarName));

        return $delete;
    }

    public function deleteProduct($productID)
    {
        $avatar_name = $this->getAvatarName($productID);

        $delete = $this->productsModel->deleteProduct($productID);

        if (!$delete)
            return false;

        //Delete avatar in directory
        $delete_avatar = $this->deleteOldImage($avatar_name);

        //Get product image names to delete
        $imageModel = $this->productImagesModel->getAllProductImages($productID);

        foreach ($imageModel as $item){

            //Delete product images in database
            $deletePI = $this->productImagesModel->deleteProductImage($item->productImageID);
            if (!$deletePI)
                continue;

            //Convert url to image name
            $image_url = $item->image_url;
            $image_array = explode('/', $image_url);
            $image_name = end($image_array);

            //Check if file exists or not in directory
            if (!file_exists(public_path().'\storage\product\\'.$image_name))
                continue;
            $deleteProductImage = $this->deleteOldImage($image_name);
        }

        return $deleteProductImage;
    }
}