<?php

namespace App\Repositories\Backend\Page;

interface PageRepositoryInterface
{
    public function getAllPageByTypeOrderById();

    public function createNewPageWithSeoId($request);

    public function showEditPage($id);

    public function updatePage($request, $id);

    public function deletePage($id);
}


