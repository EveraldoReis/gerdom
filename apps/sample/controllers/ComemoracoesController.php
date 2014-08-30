<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComemoracoesController
 *
 * @author webdev
 */
class ComemoracoesController extends FRAPS\Core\Controller
{

    //put your code here
    protected function index()
    {
        $this->set('holidays', $this->model->getAll());
        $this->set('tasks', $this->model('Agenda')->getAll());
        $this->set('clientes', $this->model('Cliente')->getAll());
    }

    protected function listar()
    {
        $this->set('holidays', $this->model->getAll());
    }

    protected function agenda()
    {
        $this->set('tasks', $this->model('Agenda')->getAll());
    }

    protected function ajax_listar()
    {
        $this->layout = 'ajax';
        $filter = array();
        if (isset($this->request->params[0])) {
            $filter['holiday_date'] = $this->request->params[0];
        }
        $this->set('holidays', $this->model->getAll($filter));
    }

    protected function novo()
    {
        
    }

    protected function post_novo()
    {
        $this->model->save($this->request->data);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function editar()
    {
        $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
    }

    protected function ver()
    {
        $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
    }

    protected function post_editar()
    {
        $this->model->update($this->request->data, array('id' => $this->request->params[0]), $this->request->data);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function remover()
    {
        
    }

    protected function post_remover()
    {
        $this->model->delete(array('id' => $this->request->data['id']));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

}
