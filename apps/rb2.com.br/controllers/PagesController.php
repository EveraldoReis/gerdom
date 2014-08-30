<?php

class PagesController extends FRAPS\Core\Controller
{

    protected function index()
    {
        $this->set('alerts', $this->model('Agenda')->getAlerts());
    }

    protected function post_index()
    {
        
    }

    protected function add()
    {
        
    }

    protected function edit()
    {
        
    }

    protected function remove()
    {
        
    }

}
