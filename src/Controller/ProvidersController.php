<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Providers Controller
 *
 * @property \App\Model\Table\ProvidersTable $Providers
 */
class ProvidersController extends AppController
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
                    $this->Flash->error('Providers has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Providers index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Providers.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->set('providers', $this->paginate($this->Providers->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['providers']);
    }

    /**
     * View method
     *
     * @param string|null $id Provider id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('provider', $provider);
        $this->set('_serialize', ['provider']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $provider = $this->Providers->newEntity();
        if ($this->request->is('post')) {
            $provider = $this->Providers->patchEntity($provider, $this->request->data);
            if ($this->Providers->save($provider)) {
                $this->Flash->success(__('The provider has been saved.'));
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
                $this->Flash->error(__('The provider could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('provider'));
        $this->set('_serialize', ['provider']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Provider id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $provider = $this->Providers->patchEntity($provider, $this->request->data);
            if ($this->Providers->save($provider)) {
                $this->Flash->success(__('The provider has been saved.'));
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
                $this->Flash->error(__('The provider could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('provider'));
        $this->set('_serialize', ['provider']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $provider = $this->Providers->get($id);
        if ($this->Providers->delete($provider)) {
            //$this->Flash->success(__('The provider has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The provider could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
