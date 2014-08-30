<?php

use FRAPS\Network\POST;

class DominiosController extends FRAPS\Core\Controller
{

    protected function index()
    {
        $this->set('domains', $this->model->getAll());
    }
    protected function ajax_listar()
    {
        $this->layout = 'ajax';
        $this->set('domains', json_encode($this->model->getAll()));
    }

    protected function novo()
    {
        $cliente = new Cliente;
        $this->set('clientes', $cliente->getAll());
    }

    protected function post_novo()
    {
        if (empty($this->request->data['dominios']['client_id'])) {
            $this->request->data['dominios']['client_id'] = $this->model('Cliente')->save($this->request->data['cliente']);
        }

        if (date('Y-m', strtotime($this->request->data['dominios']['cdate'])) > date('Y-m')) {
            $date = date('Y-m', strtotime($this->request->data['dominios']['cdate']));
            $this->request->data['dominios']['cdate'] = date('Y-m-d');
        }
        $id = $this->model->save($this->request->data['dominios']);
        if (isset($date)) {
            $this->model('Pagamento')->save(array('domain_id' => $id, 'last_payment' => $this->request->data['dominios']['cdate']));
            while (date('Y-m', strtotime($this->request->data['dominios']['cdate'])) < $date) {
                $this->request->data['dominios']['cdate'] = date('Y-m-d', strtotime('+31 days', strtotime($this->request->data['dominios']['cdate'])));
                $this->model('Pagamento')->save(array('domain_id' => $id, 'last_payment' => $this->request->data['dominios']['cdate']));
            }
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function gerenciar()
    {        
        $this->set('domains', $this->model->getAll());
    }

    protected function editar()
    {
        $this->set('clientes', new Cliente);
        if (isset($this->request->params[0])) {
            $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
        }
    }

    protected function post_editar()
    {
        if (isset($this->request->params[0])) {
            $this->model->update($this->request->data, array('id' => $this->request->params[0]));
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function post_remover()
    {
        $this->set('deleted', $this->model->delete($this->request->data));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
    
    protected function salvar_pdf(){
        $this->set('domains', $this->model->getAll());
    }

}
