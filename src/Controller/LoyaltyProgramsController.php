<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * LoyaltyPrograms Controller
 *
 * @property \App\Model\Table\LoyaltyProgramsTable $LoyaltyPrograms
 */
class LoyaltyProgramsController extends AppController
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
        if (isset($_REQUEST['a']) ) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('LoyaltyPrograms has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] LoyaltyPrograms index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['LoyaltyPrograms.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }
            $allowedSeacrhField = [];   //Example: ['title' => '~', 'total' => '=','user.city' => '=', 'receipt_date' => 'date']
            
            $rData = [];
            foreach($r as $nowR => $nowRVal){   //Preparing data to be in "Table.field" format if array is found
                if(is_array($nowRVal)){
                    foreach($nowRVal as $k => $v){
                        $rData["$nowR.$k"] = $v;
                    }
                }else{
                    $rData[$nowR] = $nowRVal;
                }
            }  
            if (count($allowedSeacrhField) > 0) {                
                foreach ($rData as $nowR => $nowRVal) {
                    if(is_array($nowRVal)){
                        $k = key($nowRVal);
                        $nowR .= '.' . $k;
                        $nowRVal = $nowRVal[$k];
                    }
                    if (in_array($nowR, array_keys($allowedSeacrhField))&& !empty($nowRVal)) {
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
        $this->set('loyaltyPrograms', $this->paginate($this->LoyaltyPrograms->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['loyaltyPrograms']);
    }

    /**
     * View method
     *
     * @param string|null $id Loyalty Program id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loyaltyProgram = $this->LoyaltyPrograms->get($id, [
            'contain' => []
        ]);
        $this->set('loyaltyProgram', $loyaltyProgram);
        $this->set('_serialize', ['loyaltyProgram']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loyaltyProgram = $this->LoyaltyPrograms->newEntity();
        if ($this->request->is('post')) {
            $loyaltyProgram = $this->LoyaltyPrograms->patchEntity($loyaltyProgram, $this->request->data);
            if ($this->LoyaltyPrograms->save($loyaltyProgram)) {
                $this->Flash->success(__('The loyalty program has been saved.'));
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
                $this->Flash->error(__('The loyalty program could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('loyaltyProgram'));
        $this->set('_serialize', ['loyaltyProgram']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Loyalty Program id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loyaltyProgram = $this->LoyaltyPrograms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loyaltyProgram = $this->LoyaltyPrograms->patchEntity($loyaltyProgram, $this->request->data);
            if ($this->LoyaltyPrograms->save($loyaltyProgram)) {
                $this->Flash->success(__('The loyalty program has been saved.'));
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
                $this->Flash->error(__('The loyalty program could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('loyaltyProgram'));
        $this->set('_serialize', ['loyaltyProgram']);
        
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Loyalty Program id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loyaltyProgram = $this->LoyaltyPrograms->get($id);
        if ($this->LoyaltyPrograms->delete($loyaltyProgram)) {
            //$this->Flash->success(__('The loyalty program has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The loyalty program could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
