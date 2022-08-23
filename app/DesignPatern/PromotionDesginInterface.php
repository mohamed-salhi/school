<?php

namespace App\DesignPatern;

interface PromotionDesginInterface
{
    public function index();
    public function store($reqest);
    public function management();
    public function delete($id);


}
