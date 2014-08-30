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
class AgendasController extends FRAPS\Core\Controller
{

//put your code here
    protected function index()
    {
        $this->set('tasks', $this->model->getAll());
    }

    protected function ajax_listar()
    {
        $this->layout = 'ajax';
        $filter = array();
        if (isset($this->request->params[0])) {
            $filter['holiday_id'] = $this->request->params[0];
        }
        $this->set('tasks', $this->model->getAll($filter));
    }

    protected function novo()
    {
        $this->set('holidays', $this->model('Comemoracao')->getAll());
        $this->set('clientes', $this->model('Cliente')->getAll());
    }

    protected function post_novo()
    {
        $ex_model = $this->model('Comemoracao');
        $holiday = $ex_model->get($this->request->data['holiday']);
        if (!$holiday) {
            $holiday_id = $ex_model->save($this->request->data['holiday']);
        } else {
            $holiday_id = $holiday->id;
        }
        if (isset($this->request->data['all_clients'])) {
            $client_ids = array();
            foreach ($this->model('Cliente')->getAll() as $client) {
                $clients_ids[] = $client->id;
            }
            $this->request->data['holiday_tasks']['client_id'] = $clients_ids;
        }
        $this->request->data['holiday_tasks']['holiday_id'] = $holiday_id;
        foreach ($this->request->data['holiday_tasks']['client_id'] as $cid) {
            $this->request->data['holiday_tasks']['client_id'] = $cid;
            $this->model->save($this->request->data['holiday_tasks']);
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function editar()
    {
        $this->set('data', $this->model->get(array('holiday_id' => $this->request->params[0])));
        $this->set('clientes', $this->model('Cliente')->getAll());
    }

    protected function ver()
    {
        $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
    }

    protected function post_editar()
    {
        $oldClients = explode(',', $this->request->data['client_ids']);
        $oldClients = array_map('trim', $oldClients);
        foreach ($oldClients as $client) {
            if (!in_array($client, $this->request->data['client_id'])) {
                $this->model->delete(array('holiday_id' => $this->request->data['holiday_id'], 'client_id' => $client));
            }
        }
        foreach ($this->request->data['client_id'] as $client) {
            $client = trim($client);
            if (!in_array($client, $oldClients)) {
                $this->model->save(array('holiday_id' => $this->request->data['holiday_id'], 'client_id' => $client));
            }
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function remover()
    {
        
    }

    protected function post_remover()
    {
        $this->model->delete(array('holiday_id' => $this->request->data['holiday_id']));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function post_remover_por_comemoracao()
    {
        $this->model->delete(array('holiday_id' => $this->request->data['holiday_id']));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

}
