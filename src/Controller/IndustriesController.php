<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Industries Controller
 *
 * @property \App\Model\Table\IndustriesTable $Industries
 */
class IndustriesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Permission->controllerPermission($this->request);
    }
    
    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    
        $conditions = array();
        if ($this->request->is('post')) {

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('Industries has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Industries index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Industries.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }
            $allowedSeacrhField = [];
            if (count($allowedSeacrhField) > 0) {
                foreach ($r as $nowR => $nowRVal) {
                    if (in_array($nowR, $allowedSeacrhField) && !empty($nowRVal)) {
                        $conditions[$nowR] = $nowRVal;
                    }
                }
            }
        }
        $this->set('industries', $this->paginate($this->Industries->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['industries']);
    }

    /**
     * View method
     *
     * @param string|null $id Industry id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $industry = $this->Industries->get($id, [
            'contain' => ['Merchants']
        ]);
        $this->set('industry', $industry);
        $this->set('_serialize', ['industry']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $industry = $this->Industries->newEntity();
        if ($this->request->is('post')) {
            $industry = $this->Industries->patchEntity($industry, $this->request->data);
            if ($this->Industries->save($industry)) {
                $this->Flash->success(__('The industry has been saved.'));
                if(!empty($this->request->data['return_url'])){
                    if($this->request->data['return_url'] == 'true'){
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    }else{
                        return $this->redirect($this->request->data['return_url']);
                    }
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The industry could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('industry'));
        $this->set('_serialize', ['industry']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Industry id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $industry = $this->Industries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $industry = $this->Industries->patchEntity($industry, $this->request->data);
            if ($this->Industries->save($industry)) {
                $this->Flash->success(__('The industry has been saved.'));
                if(!empty($this->request->data['return_url'])){
                    if($this->request->data['return_url'] == 'true'){
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    }else{
                        return $this->redirect($this->request->data['return_url']);
                    }
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The industry could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('industry'));
        $this->set('_serialize', ['industry']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Industry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $industry = $this->Industries->get($id);
        if ($this->Industries->delete($industry)) {
            //$this->Flash->success(__('The industry has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The industry could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
