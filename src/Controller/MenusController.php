<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 */
class MenusController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }
    
    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->Permission->controllerPermission($this->request);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('ParentMenus');
        /*$menus = $this->ParentMenus->find('all', [
            'contain' => ['Menus'],
            'order' => ['sort_order']
        ]);*/
        $conditions = array();
        if ($this->request->is('post')) {

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('Menus has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Menus index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Menus.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->paginate = [
            'contain' => ['Menus']
        ];
        $this->set('menus', $this->paginate($this->ParentMenus->find('all', [
            'conditions' => $conditions,
            'order' => ['ParentMenus.sort_order' => 'ASC']
                ])));
        $this->set('_serialize', ['menus']);
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus']
        ]);
        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Roles');
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
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
                $this->Flash->error(__('The menu could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->ParentMenus->find('list', ['limit' => 200]);
        $roles = $this->Roles->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'parentMenus', 'roles'));
        $this->set('_serialize', ['menu']);
        
        $this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {        
        $this->loadModel('Roles');
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
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
                $this->Flash->error(__('The menu could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->ParentMenus->find('list', ['limit' => 200]);
        $roles = $this->Roles->find('list', ['limit' => 200]);
        $this->set(compact('menu', 'parentMenus', 'roles'));
        $this->set('_serialize', ['menu']);
        
        $this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            //$this->Flash->success(__('The menu has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
