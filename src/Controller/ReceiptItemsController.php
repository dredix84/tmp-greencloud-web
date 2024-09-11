<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * ReceiptItems Controller
 *
 * @property \App\Model\Table\ReceiptItemsTable $ReceiptItems
 */
class ReceiptItemsController extends AppController
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
                    $this->Flash->error('ReceiptItems has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] ReceiptItems index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['ReceiptItems.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
            'contain' => ['Receipts']
        ];
        $this->set('receiptItems', $this->paginate($this->ReceiptItems->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['receiptItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Receipt Item id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receiptItem = $this->ReceiptItems->get($id, [
            'contain' => ['Receipts']
        ]);
        $this->set('receiptItem', $receiptItem);
        $this->set('_serialize', ['receiptItem']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $receiptItem = $this->ReceiptItems->newEntity();
        if ($this->request->is('post')) {
            $receiptItem = $this->ReceiptItems->patchEntity($receiptItem, $this->request->data);
            if ($this->ReceiptItems->save($receiptItem)) {
                $this->Flash->success(__('The receipt item has been saved.'));
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
                $this->Flash->error(__('The receipt item could not be saved. Please, try again.'));
            }
        }
        $receipts = $this->ReceiptItems->Receipts->find('list', ['limit' => 200]);
        $this->set(compact('receiptItem', 'receipts'));
        $this->set('_serialize', ['receiptItem']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Receipt Item id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receiptItem = $this->ReceiptItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $receiptItem = $this->ReceiptItems->patchEntity($receiptItem, $this->request->data);
            if ($this->ReceiptItems->save($receiptItem)) {
                $this->Flash->success(__('The receipt item has been saved.'));
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
                $this->Flash->error(__('The receipt item could not be saved. Please, try again.'));
            }
        }
        $receipts = $this->ReceiptItems->Receipts->find('list', ['limit' => 200]);
        $this->set(compact('receiptItem', 'receipts'));
        $this->set('_serialize', ['receiptItem']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Receipt Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receiptItem = $this->ReceiptItems->get($id);
        if ($this->ReceiptItems->delete($receiptItem)) {
            //$this->Flash->success(__('The receipt item has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The receipt item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
