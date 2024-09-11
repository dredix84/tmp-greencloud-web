<?php


namespace App\Controller;

use App\Service\LogHandler;

/**
 * Receipts Controller
 *
 * @property \App\Model\Table\ReceiptsTable $Receipts
 */
class RController extends AppController
{
    public function index()
    {
        $path = func_get_args();
        return $this->redirect(['controller' => 'Receipts', 'action' => 'view', $path[0]]);
    }
}
