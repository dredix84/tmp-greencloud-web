<?php
namespace App\Model\Traits;


trait TableCommon {

	/**
	 * Used to the current connection used by the Model.
	 * @param string $connection_name Name of the CakePHP connection being to use.
	 * @return \Cake\Datasource\ConnectionInterface
	 */
	public function getConnection($connection_name = 'default') {
		return \Cake\Datasource\ConnectionManager::get($connection_name);
	}

	/**
	 * Get to get an associative array based on the SQL query passed in
	 * @param string $sql SQL query
	 * @param array $params  Parameters
	 * @param string $connectionName  Database connection setting to use
	 * @param mixed $cache   Should the data be cached and if data exist in cache, the data will be used (Pass in cache name)
	 * @param boolean $clearCache  Should the cache be cleared
	 * @return array
	 */
	public function getDbData($sql, $params = [], $connectionName = 'default', $cache = FALSE, $clearCache = FALSE) {
		$conn = $this->getConnection($connectionName);
		if(!empty($params) && !is_array($params)){
			$params = [$params];
		}
		$result = $conn->execute($sql, $params)->fetchAll('assoc');
		return $result;
	}

}