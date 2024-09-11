<?php

namespace App\Model\Table;

use App\Model\Entity\Receipt;
use App\Model\Traits\TableCommon;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Receipts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 * @property \Cake\ORM\Association\BelongsTo $Providers
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $PaymentTypes
 * @property \Cake\ORM\Association\HasMany $ReceiptItems
 */
class ReceiptsTable extends Table
{
    use TableCommon;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('receipts');
        $this->setDisplayField('receipt_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('PaymentTypes', [
            'foreignKey' => 'payment_type_id'
        ]);
        $this->hasMany('ReceiptItems', [
            'foreignKey' => 'receipt_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('terminal', 'create')
            ->notEmpty('terminal');

        $validator
            ->requirePresence('receipt_number', 'create')
            ->notEmpty('receipt_number');

        $validator
            ->add('receipt_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('receipt_date');

        $validator
            ->allowEmpty('claim_number');

        $validator
            ->allowEmpty('discount_type');

        $validator
            ->add('discount', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('discount');

        $validator
            ->add('subtotal', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('subtotal');

        $validator
            ->add('tax', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('tax');

        $validator
            ->add('total', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('total');

        $validator
            ->allowEmpty('user_note');

        $validator
            ->allowEmpty('note');

        $validator
            ->allowEmpty('receipt_text_data');

        $validator
            ->allowEmpty('receipt_file');

        $validator
            ->add('should_email', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('should_email');

        $validator
            ->add('emailed', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('emailed');

        $validator
            ->add('date_emailed', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('date_emailed');

        $validator
            ->add('email_cost', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('email_cost');

        $validator
            ->allowEmpty('systen_note');

        $validator
            ->add('seen', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('seen');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        $rules->add($rules->existsIn(['provider_id'], 'Providers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['payment_type_id'], 'PaymentTypes'));
        return $rules;
    }

    /**
     * Get the count of receipts based on conditions passed in
     * @param array $conditions CakePHP condition array
     * @return int
     */
    public function getCount(array $conditions)
    {
        $query = $this->find('all', [
            'conditions' => $conditions
        ]);
        return $query->count();
    }

    /**
     * Gets the receipt cound based on user id
     * @param int $userid
     * @param array $moreConditions
     * @return int
     */
    public function getReceiptCount($userid, array $moreConditions = [])
    {
        $moreConditions['user_id'] = $userid;
        $moreConditions['refund'] = 0;
        $moreConditions['reprint'] = 0;
        $moreConditions['is_bad'] = 0;
        return $this->getCount($moreConditions);
    }

    /**
     * This function is used to mark receipts are seen (seen = 1)
     * @param type $userid ID of user for which records to be updated
     */
    public function markedSeen($userid)
    {
        $this->query()
            ->update()
            ->set(['seen' => true])
            ->where(['user_id' => $userid])
            ->execute();
    }

    public function getTransactionAmountByDate($merchantId, $date = '')
    {
        $conn = $this->getConnection();
        if ($date == '') {
            $date = date('Y-m-d');
        }
        $result = $conn->execute(
            'SELECT SUM(total) as mtotal FROM `receipts` WHERE merchant_id = ? AND DATE_FORMAT(created,\'%Y-%m-%d\') = ?',
            [$merchantId, $date]
        )->fetchAll('assoc');
        return $result[0]['mtotal'];
    }

    public function getMonthlyActivity($where, array $params, $orderby = 'ORDER BY r.receipt_date DESC', $limit = 12)
    {
        $conn = $this->getConnection();
        $baseSQL = "SELECT
	DATE_FORMAT(r.receipt_date, '%b-%Y') as txn_date,
	COUNT(r.id) AS cnt,
	IFNULL(SUM(r.total), 0.00) as amount
FROM 	receipts r
WHERE r.refund = 0 AND r.reprint = 0
$where
GROUP BY txn_date
ORDER BY txn_date DESC LIMIT $limit";
        $result = $conn->execute($baseSQL, $params)->fetchAll('assoc');
        return array_reverse($result);
    }

    /**
     * Used to query for a summary of money spent with provider
     * @param type $where
     * @param array $params
     * @param type $orderby
     * @param type $limit
     * @return type
     */
    public function getMerchantSummary($where, array $params, $orderby = 'ORDER BY cnt DESC', $limit = 100)
    {
        $conn = $this->getConnection();
        $baseSQL = "SELECT merchants.`name`, r.merchant_id,
#DATE_FORMAT(r.receipt_date, '%b-%Y') AS txn_date,
Count(r.id) AS cnt,
IFNULL( SUM(r.total), 0.00) AS amount
FROM receipts AS r
INNER JOIN merchants ON r.merchant_id = merchants.id
WHERE   r.refund = 0
AND r.reprint = 0
$where
GROUP BY r.merchant_id
#AND DATE_FORMAT(r.receipt_date, '%m-%Y')
$orderby
LIMIT $limit";
        $result = $conn->execute($baseSQL, $params)->fetchAll('assoc');
        return $result;
    }

    /**
     * Return the total amount of credit used to a merchant
     * @param int $merchantId The merchant ID
     * @return int
     */
    public function getCreditsRemaining($merchantId)
    {
        $conn = $this->getConnection();
        $baseSQL = "SELECT SUM(r.credits_used) as receipt_credits_used ,
(SELECT SUM(s.cost) FROM sms_logs s WHERE s.merchant_id = r.merchant_id) as sms_credits_used
FROM receipts r
WHERE r.merchant_id = ?
AND r.refund = 0 AND r.reprint = 0";
        $result = $conn->execute($baseSQL, [$merchantId])->fetchAll('assoc');
        $receiptCreditsUsed = $result[0]['receipt_credits_used'];
        $sms_credits_used = $result[0]['sms_credits_used'];
        $creditsUsed = $receiptCreditsUsed + $sms_credits_used;

        $baseSQL = "SELECT SUM(c.credit_amount) as credits_purchased FROM credits c WHERE c.merchant_id = ?";
        $result = $conn->execute($baseSQL, [$merchantId])->fetchAll('assoc');
        $creditPurchased = $result[0]['credits_purchased'];
        return ($creditPurchased - $creditsUsed);
    }

    /**
     * Return the sum of credit for the currect date for a merchant
     * @param type $merchantId The merchant ID
     * @return int
     */
    public function getCreditsUsedToday($merchantId)
    {
        $conn = $this->getConnection();
        $baseSQL = "SELECT IFNULL(SUM(r.credits_used), 0) as used_today
FROM receipts AS r
WHERE DATE(r.created) = ? AND r.merchant_id = ? AND r.refund = 0 AND r.reprint = 0";
        $result = $conn->execute($baseSQL, [date('Y-m-d'), $merchantId])->fetchAll('assoc');
        return $result[0]['used_today'];
    }

    /**
     * Return the credits used over a period of days or months
     * @param type $periodtype Determines how the query will get date period (month or day)
     * @param type $period Determines how far back the query is ran for
     * @return array
     */
    public function getCreditsUsedOverPeriod($merchantId, $periodtype = 'MONTH', $period = 6)
    {
        if ($periodtype == 'month') {
            $sqlPeriodType = 'MONTH';
            $date_period = "DATE_FORMAT(r.created,'%Y %M')";
            $groupby_period = "date_period";
        } else {
            $sqlPeriodType = 'DAY';
            $date_period = "DATE_FORMAT(r.created,'%d %M %Y')";
            $groupby_period = "date_period";
        }
        $conn = $this->getConnection();
        $baseSQL = "SELECT $date_period as date_period, IFNULL(SUM(r.credits_used), 0) as credits_used
FROM receipts AS r
WHERE r.created > DATE_SUB(now(), INTERVAL ? $sqlPeriodType) AND r.merchant_id = ?
AND r.refund = 0 AND r.reprint = 0
GROUP BY $groupby_period
ORDER BY date_period DESC";
        $result = $conn->execute($baseSQL, [$period, $merchantId])->fetchAll('assoc');
        return $result;
    }

    public function getCreditsPurchasedOverPeriod($merchantId, $periodtype = 'MONTH', $period = 6)
    {
        if ($periodtype == 'month') {
            $sqlPeriodType = 'MONTH';
            $date_period = "DATE_FORMAT(c.created,'%Y %M')";
            $groupby_period = 'date_period'; //"DATE_FORMAT(c.created,'%Y-%m')";
        } else {
            $sqlPeriodType = 'DAY';
            $date_period = "DATE_FORMAT(c.created,'%d %M %Y')";
            $groupby_period = 'date_period'; //"DATE_FORMAT(c.created,'%Y-%m-%d')";
        }
        $conn = $this->getConnection();
        $baseSQL = "SELECT $date_period AS date_period, IFNULL(SUM(c.credit_amount), 0) AS credits_purchased
FROM credits AS c
WHERE c.created > DATE_SUB(now(), INTERVAL ? $sqlPeriodType)
AND c.merchant_id = ?
GROUP BY $groupby_period
ORDER BY date_period DESC";

        $result = $conn->execute($baseSQL, [$period, $merchantId])->fetchAll('assoc');
        return $result;
    }

    /**
     * Used to send a email notification to user
     * @param int $receiptid
     * @return boolean
     */
    public function sendCustomerEmailNotification($receiptid, $toOverride = null)
    {
        /** @var Receipt $receipt */
        $receipt = $this->get($receiptid, [
            'contain' => ['Merchants', 'Providers', 'Users', 'PaymentTypes', 'ReceiptItems']
        ]);
        if (!empty($receipt->user->email)) {
            $email = new \Cake\Mailer\Email(\Cake\Core\Configure::read('emailprofile'));
            $email->template('customer_new_receipt', 'receipt_slim')
                ->emailFormat('both')
                ->to($toOverride ? $toOverride : $receipt->user->email)
                ->subject(_('New e-Receipt'))
                ->from(\Cake\Core\Configure::read('emailfrom'))
                ->viewVars([
                    'name' => $receipt->user->first_name,
                    'merchant_name' => $receipt->merchant->name,
                    'receipt' => $receipt
                ]);

            try {
                return $email->send() ? true : false;
            } catch (\Exception $e) {
                Log::write(
                    'error',
                    sprintf(
                        "There was an error wile attempting to send a customer receipt email. Error details: %s. Receipt: %s",
                        $e->getMessage(),
                        $receiptid
                    ),
                    [
                        'receiptId' => $receiptid,
                        'merchantId' => $receipt->merchant->id,
                        'merchantName' => $receipt->merchant->name
                    ]
                );
            }
        } else {
            return false;
        }
    }

    /**
     * Used to get the sum of credits purchased and credits used merchant ID
     * @param int $merchantId Merchant ID
     * @param bool $clearCache Determines if the cache should be cleared and
     * @return array
     */
    public function getCreditsUsedAndPurchasedTotal($merchantId, $clearCache = false)
    {
        $conn = $this->getConnection();
        $baseSQL = "SELECT
(SELECT SUM(r.credits_used) FROM `receipts` r WHERE merchant_id = ?  AND r.refund = 0 AND r.reprint = 0) as credits_used,
(SELECT SUM(c.credit_amount) FROM credits c WHERE merchant_id = ?) as credits_purchased;";
        $result = $conn->execute($baseSQL, [$merchantId, $merchantId])->fetchAll('assoc');
        return $result[0];
    }

    /**
     * Gets the loyalty point the user/customer currently has
     * @param int $user_id Customer/User ID
     * @param bool $clearCache Should the cache be cleared before getting data
     * @return int
     */
    public function getCustomerLoyalty($user_id, $clearCache = false)
    {
        $cachname = "customer_loyalty_" . $user_id;
        if ($clearCache) {  //Should cache be deleted
            \Cake\Cache\Cache::delete($cachname, '5minutes');
        }

        $data = \Cake\Cache\Cache::read($cachname, '5minutes');

        if ($data !== false) {
            return $data;
        } else {
            $conn = $this->getConnection();
            $baseSQL = "SELECT SUM(r.loyalty_cost) as loyalty FROM receipts r WHERE r.user_id = ? AND r.refund = 0 AND r.reprint = 0";
            $data = $conn->execute($baseSQL, [$user_id])->fetchAll('assoc');
            \Cake\Cache\Cache::write($cachname, $data[0]['loyalty'], '5minutes');
            return $data[0]['loyalty'];
        }
    }

    /**
     * Gets the loyalty point the customer earn for a particuylar dat
     * @param int $user_id Customer ID
     * @param type $query_date Date to check for points
     * @param bool $clearCache Should the cache be cleared
     * @return int
     */
    public function getCustomerLoyaltyforDate($user_id, $query_date, $clearCache = false)
    {
        $cachname = "customer_loyalty_" . $query_date . "_" . $user_id;
        if ($clearCache) {  //Should cache be deleted
            \Cake\Cache\Cache::delete($cachname, '5minutes');
        }

        $data = \Cake\Cache\Cache::read($cachname, '5minutes');

        if ($data !== false) {
            return $data ? $data : 0;
        } else {
            $conn = $this->getConnection();
            $baseSQL = "SELECT SUM(r.loyalty_cost) as loyalty FROM receipts r WHERE r.user_id = ? AND DATE_FORMAT(r.receipt_date,'%Y-%m-%d') = ? AND r.refund = 0 AND r.reprint = 0";
            $data = $conn->execute($baseSQL, [$user_id, $query_date])->fetchAll('assoc');
            \Cake\Cache\Cache::write($cachname, $data[0]['loyalty'], '5minutes');
            return $data[0]['loyalty'] ? $data[0]['loyalty'] : 0;
        }
    }

    public function getTransactionsByMerchant($transactionDate)
    {
        $baseSQL = "SELECT merchants.`name`, merchants.`id` as merchant_id, Count(r.id) AS receipt_count,
(SELECT count(s.cost) FROM sms_logs s WHERE s.merchant_id = r.merchant_id) as sms_count
FROM good_receipts r INNER JOIN merchants ON r.merchant_id = merchants.id
WHERE  DATE_FORMAT(r.created,'%Y-%m-%d') = ?
GROUP BY r.merchant_id;";
        return $this->getDbData($baseSQL, [$transactionDate]);

//        $conn = $this->getConnection();
//        $result = $conn->execute($baseSQL, [$transactionDate])->fetchAll('assoc');
//        return $result;
    }

    public function fixNullMedecus()
    {
        $outData = [];
        $receipts2fix = $this->find('all')
            ->where(
                [
                    'Receipts.provider_id IS NULL',
                    'Receipts.receipt_text_data LIKE' => "%MEDECUS%",
                    'Receipts.merchant_id NOT IN (SELECT m.id FROM merchants m WHERE m.test_account = 1)'
                ]
            );
        $affectedRows = [];
        foreach ($receipts2fix as $r) {
            $affectedRows[] = $r->id;
        }
        $outData['affectedRows'] = $affectedRows;
        if (count($affectedRows) > 0) {
            $this->updateAll(
                ['provider_id' => 2], ["id IN (" . implode(',', $affectedRows) . ")"]
            );
        }

        return $outData;
    }

    /**
     * Used to face a receipt file from a request
     * @param object $filename The name the file should be saved as
     * @return \stdClass
     */
    public function saveReceiptFromRequest($filename)
    {
        $outInfo = new \stdClass();
        $outInfo->uploadOk = 0;
        $outInfo->msg = 'No file found.';

        if (count($_FILES) > 0) {
            $target_dir = \Cake\Core\Configure::read('receipts_file_path');
            $target_file = $target_dir . $filename . '.pdf';
            $outInfo->uploadOk = 1;
            $FileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if ($FileType != "pdf") {
                $outInfo->uploadOk = 0;
                $outInfo->msg = "Sorry, only PDF files are allowed.";
            }

            if ($outInfo->uploadOk == 1) {
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $outInfo->msg = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                }
            }
        }

        return $outInfo;
    }

}
