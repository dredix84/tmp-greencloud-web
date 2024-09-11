<?php
namespace App\Model\Table;

use App\Model\Entity\InvoiceStatus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceStatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Invoices
 */
class InvoiceStatusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        //$this->addBehavior('Ceeram/Blame.Blame');

        $this->table('invoice_statuses');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Invoices', [
            'foreignKey' => 'invoice_status_id'
        ]);
        $this->belongsTo('CreatedByUser', [
            'foreignKey' => 'created_by',
            'className' => 'Users',
        ]);
        $this->belongsTo('ModifiedByUser', [
            'foreignKey' => 'modified_by',
            'className' => 'Users',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('description');

        $validator
            ->boolean('disable_edits')
            ->allowEmpty('disable_edits');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
