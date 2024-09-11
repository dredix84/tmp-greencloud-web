<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Credits Controller
 *
 * @property \App\Model\Table\CreditsTable $Credits
 */
class CreditsController extends AppController
{

    public function beforeRender(\Cake\Event\Event $event)
    {
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

        $conditions = array();
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term     = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('Credits has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Credits index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Credits.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
                        $k       = key($nowRVal);
                        $nowR    .= '.' . $k;
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
        $this->paginate = [
            'contain' => ['Merchants', 'Payments']
        ];
        $this->set('credits', $this->paginate($this->Credits->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['credits']);
    }

    /**
     * View method
     *
     * @param string|null $id Credit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $credit = $this->Credits->get($id, [
            'contain' => ['Merchants', 'Payments']
        ]);
        $this->set('credit', $credit);
        $this->set('_serialize', ['credit']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $credit = $this->Credits->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['payment'] = array_filter($this->request->data['payment']);
            $saveAssoc                      = [];
            if (isset($this->request->data['payment']['total'])) {
                $this->request->data['payment']['merchant_id'] = $this->request->data['merchant_id'];
                $saveAssoc[]                                   = 'Payments';
            }
            $credit = $this->Credits->patchEntity($credit, $this->request->data, ['associated' => $saveAssoc]);
            if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The credit has been saved.'));
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
                $this->Flash->error(__('The credit could not be saved. Please, try again.'));
            }
        }
        $merchants = $this->Credits->Merchants->getList();
        $payments = $this->Credits->Payments->find('list', ['limit' => 200]);
        $this->set(compact('credit', 'merchants', 'payments'));
        $this->set('_serialize', ['credit']);

        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Credit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $credit = $this->Credits->get($id, [
            'contain' => ['Payments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['payment'] = array_filter($this->request->data['payment']);
            $saveAssoc                      = [];
            if (isset($this->request->data['payment']['total'])) {
                $this->request->data['payment']['merchant_id'] = $this->request->data['merchant_id'];
                $saveAssoc[]                                   = 'Payments';
            }
            $credit = $this->Credits->patchEntity($credit, $this->request->data, ['associated' => $saveAssoc]);
            if ($this->Credits->save($credit)) {
                $this->Flash->success(__('The credit has been saved.'));
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
                $this->Flash->error(__('The credit could not be saved. Please, try again.'));
            }
        }
        $merchants = $this->Credits->Merchants->find('list', ['limit' => 200]);
        $payments  = $this->Credits->Payments->find('list', ['limit' => 200]);
        $this->set(compact('credit', 'merchants', 'payments'));
        $this->set('_serialize', ['credit']);

        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Credit id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $credit = $this->Credits->get($id);
        if ($this->Credits->delete($credit)) {
            //$this->Flash->success(__('The credit has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The credit could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
