<?php

class products extends Controller
{
    private static $requestParams;
    public function __construct()
    {
        /* Getting Request Parameters  */
        self::$requestParams = REST::getRequestParams();
        if(!self::$requestParams['user_id'])
        {
            ErrorAndMessages::generalError("Please provide UserId",400);
        }
        /* Getting Request Method */
        $request = REST::getRequestMethod();
        switch ($request) {
            case 'GET':
                self::getProducts();
                break;
            case 'POST':
                self::insertProducts();
            case 'PUT':
                self::updateProducts();
            case 'DELETE':
                self::deleteProducts();
            default:
                 ErrorAndMessages::httpError('products');
             break;
        }
    }

    private function getProducts()
    {
        $products = $this->loadModel('products');
        if(self::$requestParams['product_id'])
        {
            $productsParams = array('user_id'=>self::$requestParams['user_id'],'product_id'=>self::$requestParams['product_id']);
        }
        else
        {
            $productsParams = array('user_id'=>self::$requestParams['user_id']);
        }
        $data = $products->getProducts($productsParams);
        if(empty($data))
        {
             ErrorAndMessages::generalError("product id doesnot exist",400);
        }
        ErrorAndMessages::contentHandling($data,'products');
    }

     private function deleteProducts()
    {
        $products = $this->loadModel('products');
        if(self::$requestParams['product_id'])
        {
            $productsParams = array('user_id'=>self::$requestParams['user_id'],'product_id'=>self::$requestParams['product_id']);
        }
        else
        {
            $productsParams = array('user_id'=>self::$requestParams['user_id']);
        }
        $data = $products->deleteProducts($productsParams);
        if(empty($data))
        {
             ErrorAndMessages::generalError("product id doesnot exist",400);
        }
        ErrorAndMessages::contentHandling($data,'No. of product deleted','product deleted successfully');
    }

    private function insertProducts()
    {
        $products = $this->loadModel('products');
        $data = $products->insertProducts(self::$requestParams);
        if(empty($data))
        {
             ErrorAndMessages::generalError("Product doesnot inserted",400);
        }
        ErrorAndMessages::contentHandling($data,'Product Id','product created successfully');
    }

    private function updateProducts()
    {
        if(empty(self::$requestParams['product_id']))
        {
            ErrorAndMessages::generalError("Please enter product id",400);
        }
        $products = $this->loadModel('products');
        $data = $products->updateProducts(self::$requestParams);
        if(empty($data))
        {
             ErrorAndMessages::generalError("Product doesnot updated",400);
        }
        ErrorAndMessages::contentHandling(self::$requestParams['product_id'],'Product Id','product updated successfully');
    }
}