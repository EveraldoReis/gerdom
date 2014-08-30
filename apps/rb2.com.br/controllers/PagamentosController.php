<?php

class PagamentosController extends FRAPS\Core\Controller
{

    protected function index()
    {
        
    }

    protected function post_novo()
    {

        if (date('Y-m', strtotime($this->request->data['last_payment'])) > date('Y-m')) {
            $date = date('Y-m', strtotime($this->request->data['last_payment']));
            $this->request->data['last_payment'] = date('Y-m-d');
            $this->model->save($this->request->data);
            while (date('Y-m', strtotime($this->request->data['last_payment'])) < $date) {
                $this->request->data['last_payment'] = date('Y-m-d', strtotime('+31 days', strtotime($this->request->data['last_payment'])));
                $this->model->save($this->request->data);
            }
        } else {
            $this->model->save($this->request->data);
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function post_novo_multi()
    {
        $ids = array_unique(explode(',', $this->request->data['domain_id_list']));
        unset($this->request->data['domain_id_list']);
        foreach ($ids as $this->request->data['domain_id']) {
            if ($this->model->get($this->request->data) == false) {
                if (date('Y-m', strtotime($this->request->data['last_payment'])) > date('Y-m')) {
                    $date = date('Y-m', strtotime($this->request->data['last_payment']));
                    $this->request->data['last_payment'] = date('Y-m-d');
                    if ($this->model->get($this->request->data) == false) {
                        $this->model->save($this->request->data);
                    }
                    while (date('Y-m', strtotime($this->request->data['last_payment'])) < $date) {
                        $this->request->data['last_payment'] = date('Y-m-d', strtotime('+31 days', strtotime($this->request->data['last_payment'])));
                        if ($this->model->get($this->request->data) == false) {
                            $this->model->save($this->request->data);
                        }
                    }
                } else {
                    $this->model->save($this->request->data);
                }
            }
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    protected function post_editar()
    {
        $this->set('data', $this->model->get(array('id' => $this->request->params[0])));
    }

    protected function historico()
    {
        
    }

    protected function post_remover()
    {
        $this->set('deleted', $this->model->delete($this->request->data));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

}
