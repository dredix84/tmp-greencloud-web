<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

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
    
        $conditions = array();
        if (isset($_REQUEST['a']) ) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('Invoices has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Invoices index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Invoices.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
            'contain' => ['InvoiceStatuses', 'Merchants', 'ToMerchants']
        ];
        $this->set('invoices', $this->paginate($this->Invoices->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['invoices']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['InvoiceStatuses', 'Merchants', 'ToMerchants']
        ]);
        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been  created.'));
                return $this->redirect(['action' => 'edit', $invoice->id]);
                
                /*if(!empty($this->request->data['return_url'])){
                    if($this->request->data['return_url'] == 'true'){
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    }else{
                        return $this->redirect($this->request->data['return_url']);
                    }
                }else{
                    return $this->redirect(['action' => 'index']);
                }*/
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $invoiceStatuses = $this->Invoices->InvoiceStatuses->find('list', ['limit' => 200]);
        $merchants = $this->Invoices->Merchants->find('list', ['limit' => 200]);
        $toMerchants = $this->Invoices->ToMerchants->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'invoiceStatuses', 'merchants', 'toMerchants'));
        $this->set('_serialize', ['invoice']);
        
        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
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
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $invoiceStatuses = $this->Invoices->InvoiceStatuses->find('list', ['limit' => 200]);
        $merchants = $this->Invoices->Merchants->find('list', ['limit' => 200]);
        $toMerchants = $this->Invoices->ToMerchants->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'invoiceStatuses', 'merchants', 'toMerchants'));
        $this->set('_serialize', ['invoice']);
        
        //$this->render('addedit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            //$this->Flash->success(__('The invoice has been deleted.'));
        } else {
            throw new NotFoundException(__('Unable to delete record.'));
            //$this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
