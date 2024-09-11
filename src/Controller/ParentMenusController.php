<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * ParentMenus Controller
 *
 * @property \App\Model\Table\ParentMenusTable $ParentMenus
 */
class ParentMenusController extends AppController
{

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
                    $this->Flash->error('ParentMenus has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] ParentMenus index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['ParentMenus.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->set('parentMenus', $this->paginate($this->ParentMenus->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['parentMenus']);
    }

    /**
     * View method
     *
     * @param string|null $id Parent Menu id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parentMenu = $this->ParentMenus->get($id, [
            'contain' => ['Menus']
        ]);
        $this->set('parentMenu', $parentMenu);
        $this->set('_serialize', ['parentMenu']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parentMenu = $this->ParentMenus->newEntity();
        if ($this->request->is('post')) {
            $parentMenu = $this->ParentMenus->patchEntity($parentMenu, $this->request->data);
            if ($this->ParentMenus->save($parentMenu)) {
                $this->Flash->success(__('The parent menu has been saved.'));
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
                $this->Flash->error(__('The parent menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parentMenu'));
        $this->set('_serialize', ['parentMenu']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Parent Menu id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parentMenu = $this->ParentMenus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parentMenu = $this->ParentMenus->patchEntity($parentMenu, $this->request->data);
            if ($this->ParentMenus->save($parentMenu)) {
                $this->Flash->success(__('The parent menu has been saved.'));
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
                $this->Flash->error(__('The parent menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parentMenu'));
        $this->set('_serialize', ['parentMenu']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Parent Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parentMenu = $this->ParentMenus->get($id);
        if ($this->ParentMenus->delete($parentMenu)) {
            //$this->Flash->success(__('The parent menu has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The parent menu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
