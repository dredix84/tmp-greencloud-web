<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Roadmaps Controller
 *
 * @property \App\Model\Table\RoadmapsTable $Roadmaps
 */
class RoadmapsController extends AppController
{

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        
        $priorities = ['Unknown', 'Low', 'Medium', 'High', 'Critical'];
        $statuses = ['Not started', 'Working on', 'Completed'];
        $statusClass = ['danger', 'warning', 'success'];
        $icons = [
            'star' => 'Stars',
            'heart' => 'Heart',
            'thumbs-up' => 'Thumbs up',
            'map-marker' => 'map-marker'
            ];
        $this->set(compact('priorities', 'statuses', 'icons', 'statusClass'));
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
                $orFields = ['title', 'description'];
                if (count($orFields) == 0) {
                    $this->Flash->error('Roadmaps has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Roadmaps index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Roadmaps.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->paginate = [
            'contain' => ['Users']
        ];
        //$this->set('roadmaps', $this->paginate($this->Roadmaps->find('all', ['conditions' => $conditions])));
        $this->set('roadmaps', $this->Roadmaps->find('all', ['conditions' => $conditions, 'order' => ['Roadmaps.delivery_date' => 'DESC']]));
        $this->set('_serialize', ['roadmaps']);
    }

    /**
     * View method
     *
     * @param string|null $id Roadmap id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roadmap = $this->Roadmaps->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('roadmap', $roadmap);
        $this->set('_serialize', ['roadmap']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roadmap = $this->Roadmaps->newEntity();
        if ($this->request->is('post')) {
            $roadmap = $this->Roadmaps->patchEntity($roadmap, $this->request->data);
            if ($this->Roadmaps->save($roadmap)) {
                $this->Flash->success(__('The roadmap has been saved.'));
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
                $this->Flash->error(__('The roadmap could not be saved. Please, try again.'));
            }
        }
        $users = $this->Roadmaps->Users->find('list', ['limit' => 200, 'conditions' => ['role_id' => 0]]);
        $this->set(compact('roadmap', 'users'));
        $this->set('_serialize', ['roadmap']);
        
        $this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Roadmap id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roadmap = $this->Roadmaps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roadmap = $this->Roadmaps->patchEntity($roadmap, $this->request->data);
            if ($this->Roadmaps->save($roadmap)) {
                $this->Flash->success(__('The roadmap has been saved.'));
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
                $this->Flash->error(__('The roadmap could not be saved. Please, try again.'));
            }
        }
        $users = $this->Roadmaps->Users->find('list', ['limit' => 200]);
        $this->set(compact('roadmap', 'users'));
        $this->set('_serialize', ['roadmap']);
        
        $this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Roadmap id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roadmap = $this->Roadmaps->get($id);
        if ($this->Roadmaps->delete($roadmap)) {
            $this->Flash->success(__('The roadmap has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            $this->Flash->error(__('The roadmap could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
