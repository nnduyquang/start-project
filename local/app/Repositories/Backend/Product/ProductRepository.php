<?php

namespace App\Repositories\Backend\Product;

use App\CategoryItem;
use App\Direction;
use App\Location;
use App\Repositories\EloquentRepository;
use App\Seo;
use App\Unit;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return \App\Product::class;
    }



    public function showCreateProduct()
    {
        $data = [];
        $location = new Location();
        $categoryItem = new CategoryItem();
        $direction = new Direction();
        $unit = new Unit();
        $categoryProduct = $categoryItem->getAllParent('order', CATEGORY_PRODUCT);
        $cities = $location->getAllCities();
        $directions = $direction->getAllDirection();
        $units = $unit->getAllUnit();
        $data['cities'] = $cities;
        $data['categoryProduct'] = $categoryProduct;
        $data['directions'] = $directions;
        $data['units'] = $units;
        return $data;
    }

    public function getAllDistrictsByCity($request)
    {
        $data = [];
        $id = $request['id'];
        $location = new Location();
        $wards = $location->getAllChildById($id);
        $data['success'] = 'success';
        $data['districts'] = $wards;
        return $data;
    }

    public function getAllWardsByDistrict($request)
    {
        $data = [];
        $id = $request['id'];
        $location = new Location();
        $wards = $location->getAllChildById($id);
        $data['success'] = 'success';
        $data['wards'] = $wards;
        return $data;
    }

    public function createNewProduct($request)
    {
        $data = [];
        $seo = new Seo();
        if (!$seo->isSeoParameterEmpty($request)) {
            $seo = Seo::create($request->all());
            $request->request->add(['seo_id' => $seo->id]);
        } else {
            $request->request->add(['seo_id' => null]);
        }
        $parameters = $this->_model->prepareParameters($request);
        $result = $this->_model->create($parameters->all());
        $attachData = array();
        foreach ($parameters['list_category_id'] as $key=>$item){
            $attachData[$item]=array('type'=>CATEGORY_PRODUCT);
        }
        $result->categoryitems(CATEGORY_PRODUCT)->attach($attachData);
        return $data;
    }

    public function showEditProduct($id)
    {
        $data['product'] = $this->find($id);
        $data['districts']=null;
        $data['district_id']=null;
        $data['wards']=null;
        $data['ward_id']=null;
        $location = new Location();
        $direction = new Direction();
        $categoryItem = new CategoryItem();
        $directions = $direction->getAllDirection();
        $data['directions'] = $directions;
        $unit = new Unit();
        $units = $unit->getAllUnit();
        $data['units'] = $units;
        $categoryProduct = $categoryItem->getAllParent('order', CATEGORY_PRODUCT);
        $data['categoryProduct'] = $categoryProduct;
        $level = $location->findLevelById($data['product']->location_id);
        switch ($level) {
            case 0:
                $data['cities']=$location->getAllCities();
                $data['city_id']=$data['product']->location_id;
                $data['districts']=$location->getAllChildById($data['product']->location_id);
                break;
            case 1:
                $parentIdDistrict=$location->findParentById($data['product']->location_id);
                $data['districts']=$location->getAllChildById($parentIdDistrict);
                $data['district_id']=$data['product']->location_id;
                $data['cities']=$location->getAllCities();
                $data['city_id']=$parentIdDistrict;
                $data['wards'] = $location->getAllChildById($data['product']->location_id);
                break;
            case 2:
                $parentIdWard = $location->findParentById($data['product']->location_id);
                $data['wards'] = $location->getAllChildById($parentIdWard);
                $data['ward_id']=$data['product']->location_id;
                $parentIdDistrict=$location->findParentById($data['ward_id']);
                $data['district_id']=$parentIdDistrict;
                $parentIDCity=$location->findParentById($parentIdDistrict);
                $data['districts']=$location->getAllChildById($parentIDCity);
                $data['cities']=$location->getAllCities();
                $data['city_id']=$parentIDCity;
                break;
        }
        return $data;
    }

    public function updateProduct($request, $id)
    {
        $data = [];
        $parameters = $this->_model->prepareParameters($request);
        $result = $this->update($id,$parameters->all());
        $seo = new Seo();
        if (!$seo->isSeoParameterEmpty($request)) {
            if(is_null($result->seo_id)){
                $data = Seo::create($request->all());
                $result->update(['seo_id'=>$data->id]);
            }else{
                $result->seos->update($parameters->all());
            }
        }else{
            if(!is_null($result->seo_id)){
                $result->seos->delete();
            }
        }
        $syncData = array();
        foreach ($parameters['list_category_id'] as $key=>$item){
            $syncData[$item]=array('type'=>CATEGORY_PRODUCT);
        }
        $result->categoryitems(CATEGORY_PRODUCT)->sync($syncData);
        return $data;
    }

    public function deleteProduct($id)
    {
        $data = [];
        $this->delete($id);
        return $data;
    }


}