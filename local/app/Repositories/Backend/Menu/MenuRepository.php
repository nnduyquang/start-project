<?php

namespace App\Repositories\Backend\Menu;

use App\Menu;
use App\Repositories\EloquentRepository;

class MenuRepository extends EloquentRepository implements MenuRepositoryInterface
{
    public function getModel()
    {
        return \App\Menu::class;
    }

    public function createNewMenuItem($request)
    {
        $data = $this->_model->prepareParameters($request);
        $data['order'] = $this->_model->highestOrderMenuItem();
        $result = $this->create($data->all());
        return redirect()->route('menu.index')->with('success', 'Tạo Mới Thành Công Bài Viết');
    }

    public function updateMenuItem($request)
    {
        $id = $request->input('id');
        $data = $this->_model->prepareParameters($request->except(['id']));
        $menuItem = $this->find($id);
        $result = $menuItem->update($data);
        return redirect()->route('menu.index')->with('success', 'Cập Nhật Thành Công Bài Viết');
    }

    public function orderMenu()
    {

    }


    public function getAllMenuItem()
    {
        return $this->getAll();
    }


}