<?php

class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
    public $name = 'Posts';

    function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post inválido'));
        }

        $post = $this->set('post', $this->Post->findById($id));
        if(!$post) {
            throw new NotFoundException(__('Post inválido'));
        }

        $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('Seu post foi salvo.');
                return $this->redirect(array('action' => 'index'));
            }
            
            $this->Flash->error(__('Não foi possível salvar seu post.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post inválido'));
        }

        $post = $this->Post->findById($id);
        
        if(!$post) {
            throw new NotFoundException(__('Post inválido'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;

            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Seu post foi atualizado.'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Flash->error(__('Não foi possível atualizar seu post.'));
        }

        if ($this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('O post #%s foi apagado.', h($id))
            );
        } else {
            $this->Flash->error(
                __('O post #%s não pode ser apagado.', h($id))
            );
        }
    
        return $this->redirect(array('action' => 'index'));
    }

}