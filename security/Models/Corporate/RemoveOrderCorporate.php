<?php

namespace security\Models\Corporate;

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public/init.php';

use \PDO;
use \security\Models\Corporate\BaseCorporate;
use \stdClass;

class RemoveOrderCorporate extends BaseCorporate
{
    private $errors = [];
    private $orderID;
    private $customerID;

    public function __construct(stdClass $models, stdClass $customerData)
    {
        parent::__construct($models);
        $this->groupID = $customerData->groupID;
        $this->orderID = $customerData->orderID;
    }
    public function removeOrder()
    {
        $groupID = $this->groupID;
        $orderID = $this->orderID;
        $errors = $this->errors;
        $pdo = $this->pdo;
        $query = "DELETE cTo, gTo, o
           FROM orders AS o
           JOIN (customersToOrders AS cTo,
            groupsToOrders AS gTo)
           ON o.id = cTo.orders_id AND gTo.orders_id=o.id
           WHERE gTo.groups_id = :groupID AND
           o.id = :orderID";
        $stmt = $pdo->prepare($query);
        if (!$stmt) {
            $errors[] = "Unable to delete this record.";
            $this->logger->addCritical("Unable to delete order number $orderID for group $groupID");
        }
        $stmt->bindParam(':groupID', $groupID, PDO::PARAM_INT);
        $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $success = $stmt->execute();
        $errorInfo = $stmt->errorInfo();
        if (isset($errorInfo[2]) && $this->isDev()) {
            $errors[] = $errorInfo[2];
        }
        $deletedNumber = $stmt->rowCount();
        if (!$success || !$deletedNumber) {
            $errors[] = "Unable to delete this record.";
        } else {
            $this->data = [
                "id" => $orderID,
                "numberRemoved" => "Removed the order",
            ];
            return $this->data;
        }
        if (!empty($errors)) {
            $this->errorRunner->runErrors($errors);
        }
    }
}
