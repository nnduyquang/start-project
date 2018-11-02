<?php

namespace App\Repositories\Backend\Page;

use App\Repositories\EloquentRepository;
use App\Seo;

class PageRepository extends EloquentRepository implements PageRepositoryInterface{
    public function getModel()
    {
        return \App\Post::class;
    }
    public function getAllPageByTypeOrderById()
    {
        return $this->_model::where('post_type', '=', IS_PAGE)->orderBy('id', 'DESC')->get();
    }

    public function createNewPageWithSeoId($request)
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
        return $data;
    }

    public function showEditPage($id)
    {
        $data = [];
        $data['page'] = $this->find($id);
        return $data;
    }

    public function updatePage($request, $id)
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
        return $data;
    }

    public function deletePage($id)
    {
        $data = [];
        $this->delete($id);
        return $data;
    }


}