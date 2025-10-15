<?php

namespace Foundation;

use Entity\ETable;
use Exception;

/**
 * Class FTable
 * Handles CRUD and others operations for tables in the database.
 */
class FTable {
    /**
     * Name of the table associated with the table entity in the database.
     */
    protected const TABLE_NAME = 'tables';

    // Error messages centralized for consistency
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the table.';
    protected const ERR_RETRIVE_TABLE='Failed to retrive the inserted table.';
    protected const ERR_TABLE_NOT_FOUND = 'The table does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_RETRIVE_ID = 'It was not possible to retrive the table id.';

    /**
     * Creates a new table in the database.
     *
     * @param ETable $table The table object to save.
     * @return int The ID of the saved record, or 0 if the save fails.
     * @throws Exception If an error occurs.
     */
    public function create(ETable $table): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($table);
        try {
            //Table insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Get the last Id insereted
            $createdId=$db->getLastInsertedId();
            if ($createdId == null) {
                throw new Exception(self::ERR_RETRIVE_ID);
            }
            //Retrive the inserted table by number to get the assigned idTable
            $storedTable = $db->load(self::TABLE_NAME, 'idTable', $createdId);
            if ($storedTable === null) {
                throw new Exception(self::ERR_RETRIVE_TABLE);
            }
            //Assign the retrieved ID to the object
            $table->setIdTable((int)$createdId);
            //Return the id associated with this table
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a table from the database by their ID.
     *
     * @param int $id The ID of the table to read.
     * @return ETable|null The table object if found, null otherwise.
     */
    public function read(int $id): ?ETable {
        $db = FDatabase::getInstance();
        $result = $db->load(static::TABLE_NAME, 'idTable', $id);
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**
     * Updates an existing table in the database.
     *
     * @param ETable $table The table object to update.
     * @return bool True if the update was successful, False otherwise.
     * @throws Exception If an error occurs.
     */
    public function update(ETable $table): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($table->getIdTable())) {
            throw new Exception(self::ERR_TABLE_NOT_FOUND);
        }
        $data = [
            'areaName' => $table->getAreaName(),
            'maxGuests' => $table->getMaxGuests(),
        ];
        if (!$db->update(self::TABLE_NAME, $data, ['idTable' => $table->getIdTable()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a table from the database by their ID.
     *
     * @param int $idTable The ID of the table to delete.
     * @return bool True if the deletion was successful, False otherwise.
     */
    public function delete(int $idTable): bool {
        $db = FDatabase::getInstance();
        return $db->delete(static::TABLE_NAME, ['idTable' => $idTable]);
    }

    /**
     * Loads a list of tables from the database.
     *
     * @return ETable[]
     */
    public static function readAll(): array {
        $db = FDatabase::getInstance();
        $result = $db->loadMultiples(self::TABLE_NAME);
        return array_map([self::class, 'arrayToEntity'], $result);
    }

    /**
     * Checks if a table with the given ID exists in the database.
     *
     * @param int $idTable The ID of the table to check.
     * @return bool True if the table exists, false otherwise.
     */
    public static function exists(int $idTable): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idTable' => $idTable]);
    }

    /**
     * Creates an ETable entity from an associative array.
     *
     * @param array $data The data array containing table information.
     * @return ETable The created ETable instance.
     */
    public static function arrayToEntity(array $data): ETable { //NOTA: mancano i soliti check sui dati perchè sono informazioni che non vengono toccate da nessun utente della Web App
        return new ETable(
            $data['idTable'] ?? null,
            $data['areaName'] ?? null,
            $data['maxGuests'] ?? null
        );
    }

    /**
     * Converts an ETable object into an associative array for the database.
     *
     * @param ETable $table The table object to convert.
     * @return array The table data as an array.
     */
    private function entityToArray(ETable $table): array {
        return [
            'idTable' => $table->getIdTable(),
            'areaName' => $table->getAreaName(),
            'maxGuests' => $table->getMaxGuests(),
        ];
    }
}