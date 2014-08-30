<?php

class ClientesController extends FRAPS\Core\Controller
{

    protected function index()
    {
        
    }

    protected function novo()
    {
        $this->set('domains', new Dominio);
    }

    protected function post_novo()
    {
        $this->model->save($this->request->data['cliente']);
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
