<?php

namespace App\Repositories\Backend\Menu;

interface MenuRepositoryInterface
{
    public function createNewMenuItem($request);

    public function updateMenuItem($request);

    public function orderMenu();

    public function getAllMenuItem();
}