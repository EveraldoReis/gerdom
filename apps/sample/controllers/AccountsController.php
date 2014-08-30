<?php

class AccountsController extends FRAPS\Core\Controller
{

    protected function index()
    {
        $this->set('accounts', $this->model->getAll());
    }

    protected function novo()
    {
        
    }

    protected function post_novo()
    {
        $this->request->data['password'] = sha1($this->request->data['password']);
        $this->model->save($this->request->data);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }

    protected function editar()
    {
        $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
    }

    protected function post_editar()
    {
        $this->model->update($this->request->data, array('id' => $this->request->params[0]));
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }

    protected function remover()
    {
        
    }

    public function post_remover()
    {
        if (sizeof($this->model->getAll()) > 1) {
            $this->model->delete($this->request->data);
        }
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }

}
