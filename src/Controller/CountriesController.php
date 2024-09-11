<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Permission->controllerPermission($this->request);
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
                    $this->Flash->error('Countries has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Countries index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Countries.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->set('countries', $this->paginate($this->Countries->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['countries']);
    }

    /**
     * View method
     *
     * @param string|null $id Country id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => ['Locations']
        ]);
        $this->set('country', $country);
        $this->set('_serialize', ['country']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->Countries->newEntity();
        if ($this->request->is('post')) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
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
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
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
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $country = $this->Countries->get($id);
        if ($this->Countries->delete($country)) {
            //$this->Flash->success(__('The country has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
