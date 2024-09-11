<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController {

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
    public function index() {

        $conditions = array();
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = ['title'];
                if (count($orFields) == 0) {
                    $this->Flash->error('Roles has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Roles index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Roles.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }
            $allowedSeacrhField = [];   //Example: ['title' => '~', 'total' => '=','user.city' => '=', 'receipt_date' => 'date']

            $rData = [];
            foreach ($r as $nowR => $nowRVal) {   //Preparing data to be in "Table.field" format if array is found
                if (is_array($nowRVal)) {
                    foreach ($nowRVal as $k => $v) {
                        $rData["$nowR.$k"] = $v;
                    }
                } else {
                    $rData[$nowR] = $nowRVal;
                }
            }
            if (count($allowedSeacrhField) > 0) {
                foreach ($rData as $nowR => $nowRVal) {
                    if (is_array($nowRVal)) {
                        $k = key($nowRVal);
                        $nowR .= '.' . $k;
                        $nowRVal = $nowRVal[$k];
                    }
                    if (in_array($nowR, array_keys($allowedSeacrhField)) && !empty($nowRVal)) {
                        if ($allowedSeacrhField[$nowR] == '~') {
                            $conditions["$nowR LIKE "] = "%" . trim($nowRVal) . "%";
                        } elseif ($allowedSeacrhField[$nowR] == 'date') {
                            $conditions["DATE_FORMAT($nowR,'%Y-%m-%d')"] = trim($nowRVal);
                        } else {
                            $conditions[$nowR] = trim($nowRVal);
                        }
                    }
                }
            }
        }
        $this->set('roles', $this->paginate($this->Roles->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                if (!empty($this->request->data['return_url'])) {
                    if ($this->request->data['return_url'] == 'true') {
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        return $this->redirect($this->request->data['return_url']);
                    }
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);

        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                if (!empty($this->request->data['return_url'])) {
                    if ($this->request->data['return_url'] == 'true') {
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        return $this->redirect($this->request->data['return_url']);
                    }
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);

        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            //$this->Flash->success(__('The role has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Used to edit role permissions
     */
    public function editPermissions($id) {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role->permissions = $this->request->data['permissions'];
            $role->modified_by = $this->userinfo['id'];
            //$role->permissions = 'TEST';
            //die(pr($this->request->data));
            //$role = $this->Roles->patchEntity($role, $this->request->data);
            //die(pr([$role]));
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role permissions have been updated.'));
                if (!empty($this->request->data['return_url'])) {
                    if ($this->request->data['return_url'] == 'true') {
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        return $this->redirect($this->request->data['return_url']);
                    }
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The role permissions could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

}
