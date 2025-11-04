<?php
namespace Foundation;

use Entity\EDeliveryItem;
use Exception;

class FDeliveryItem {
    protected const TABLE_NAME = 'deliveryitem';

    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_ID_DELIVERY_ITEM="The 'idDeliveryItem' field must be an integer if provided.";
    protected const ERR_ID_DELIVERY_RESERVATION="The 'idDeliveryReservation' field is required and must be an integer.";
    protected const ERR_ID_PRODUCT="The 'idProduct' field is required and must be an integer.";
    protected const ERR_QUANTITY="The 'quantity' field is required and must be a non-negative number.";
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted delivery item";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the delivery item.';
    protected const ERR_RETRIVE_DELIVERY_ITEM='Failed to retrieve the inserted delivery item.';
    protected const ERR_DELIVERY_ITEM_NOT_FOUND = 'The delivery item does not exist.';
    protected const ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_ALL_DELIVERY_ITEMS = 'Error loading all delivery items: ';
    protected const ERR_PRODUCT_NOT_FOUND='Product not found for this delivery item';

    public function create(EDeliveryItem $deliveryItem): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($deliveryItem);
        self::validateDeliveryItemData($data);
        $result = $db->insert(self::TABLE_NAME, $data);
        if ($result === null) {
            throw new Exception(self::ERR_INSERTION_FAILED);
        }
        $deliveryItem->setIdDeliveryItem($result);
        return $result;
    }

    public function read(int $idDeliveryItem): ?EDeliveryItem {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'idDeliveryItem', $idDeliveryItem);
        return $result ? $this->arrayToEntity($result) : null;
    }

    public static function delete(int $idDeliveryItem): bool {
        $db = FDatabase::getInstance();
        return $db->delete(self::TABLE_NAME, ['idDeliveryItem' => $idDeliveryItem]);
    }

    /**
     * Restituisce tutti gli item associati a una specifica prenotazione delivery.
     *
     * @param int $idDeliveryReservation
     * @return EDeliveryItem[] Array di oggetti EDeliveryItem
     */
    public static function readAllItemsByReservation(int $idDeliveryReservation): array {
        $db = FDatabase::getInstance();
        $rows = $db->fetchDeliveryItemsByReservation($idDeliveryReservation);
        $items = [];

        foreach ($rows as $row) {
            $item = new \Entity\EDeliveryItem(
                $row['idDeliveryItem'],
                $row['idDeliveryReservation'],
                $row['idProduct'],
                $row['quantity'],
                $row['subtotal']
            );
            $items[] = $item;
        }

        return $items;
    }

    public function readAll(): array {
        try {
            $db = FDatabase::getInstance();
            $results = $db->loadMultiples(self::TABLE_NAME);
            return array_filter(array_map([$this, 'arrayToEntity'], $results));
        } catch (Exception $e) {
            error_log(self::ERR_ALL_DELIVERY_ITEMS . $e->getMessage());
            return [];
        }
    }

    public static function exists(int $idDeliveryItem): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idDeliveryItem' => $idDeliveryItem]);
    }

    public static function validateDeliveryItemData(array $data): void {
        if (isset($data['idDeliveryItem']) && !is_int($data['idDeliveryItem'])) {
            throw new Exception(self::ERR_ID_DELIVERY_ITEM);
        }
        if (!isset($data['idDeliveryReservation']) || !is_int($data['idDeliveryReservation'])) {
            throw new Exception(self::ERR_ID_DELIVERY_RESERVATION);
        }
        if (!isset($data['idProduct']) || !is_int($data['idProduct'])) {
            throw new Exception(self::ERR_ID_PRODUCT);
        } elseif (!FProduct::exists((string)$data['idProduct'])) {
            throw new Exception(self::ERR_PRODUCT_NOT_FOUND);
        }
        if (!isset($data['quantity']) || !is_numeric($data['quantity']) || $data['quantity'] < 0) {
            throw new Exception(self::ERR_QUANTITY);
        }
    }

    public function arrayToEntity(array $data): EDeliveryItem {
        return new EDeliveryItem(
            (int)($data['idDeliveryItem'] ?? 0),
            (int)$data['idDeliveryReservation'],
            (int)$data['idProduct'],
            (float)$data['quantity'],
            (float)($data['subtotal'] ?? 0)
        );
    }

    public function entityToArray(EDeliveryItem $deliveryItem): array {
        return [
            'idDeliveryItem' => $deliveryItem->getIdDeliveryItem(),
            'idDeliveryReservation' => $deliveryItem->getIdDeliveryReservation(),
            'idProduct' => $deliveryItem->getIdProduct(),
            'quantity' => $deliveryItem->getQuantity(),
            'subtotal' => $deliveryItem->getSubtotal()
        ];
    }
}