<?php

namespace Foundation;

use Entity\EExtra;
use Exception;

/**
 * Class FExtra to manage extra items in the database.
 */
class FExtra {

    /**
     * Name of the table associated with the extra entity in the database.
     */
    protected const TABLE_NAME = 'extra';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_NAME_FIELD="The 'name' field is required and must be a string.";
    protected const ERR_DUPLICATE_EXTRA='An extra with this name already exists.';
    protected const ERR_NUMERIC_PRICE="The 'price' field is required and must be numeric.";
    protected const ERR_NEGATIVE_PRICE="The 'price' field must be a non-negative value.";
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted extra";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the extra.';
    protected const ERR_RETRIVE_EXTRA='Failed to retrive the inserted extra.';
    protected const ERR_EXTRA_NOT_FOUND = 'The extra does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_ALL_EXTRA = 'Error loading all extras: ';

    /**
     * Create an EExtra object in the database.
     *
     * @param EExtra $extra The EExtra object to store.
     * @return bool True if the operation was successful, otherwise False.
     * @throws Exception If there is an error during the create operation.
     */
    public function create(EExtra $extra): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($extra);
        self::validateExtraData($data);
        try {
            //Extra insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted extra by number to get the assigned idExtra
            $storedExtra = $db->load(self::TABLE_NAME, 'idExtra', $createdId);
            if ($storedExtra === null) {
                throw new Exception(self::ERR_RETRIVE_EXTRA);
            }
            //Assign the retrieved ID to the object
            $extra->setIdExtra((int)$createdId);
            //Return the id associated with this extra
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a specific extra from the database by IDextra.
     *
     * @param int $idExtra The ID of the Extra to read.
     * @return EExtra|null The Extra object if found, null otherwise.
     */
    public function read(int $idExtra): ?EExtra {
        $db=FDatabase::getInstance();
        $result=$db->load(self::TABLE_NAME, 'idExtra', $idExtra);
        return $result ? $this->arrayToEntity($result): null;
    }

    /**
     * Reads an extra from the database by name.
     *
     * @param string $nameExtra The name of the extra to search for.
     * @return EExtra|null The Extra object if found, null otherwise.
     */
    public static function readByName(string $nameExtra): ?EExtra {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'name', $nameExtra);
        if (!$result) {
            return null;
        }
        // Temporary instance
        $tmp = new self();
        return $tmp->arrayToEntity($result);
    }

    /**
     * Updates an EExtra object in the database.
     *
     * @param EExtra $extra The EExtra object to update.
     * @return bool True if the update was successful, false otherwise.
     * @throws Exception If there is an error during the update operation.
     */
    public function update(EExtra $extra): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($extra->getIdExtra())) {
            throw new Exception(self::ERR_EXTRA_NOT_FOUND);
        }
        $data = [
            'name' => $extra->getNameExtra(),
            'price' => $extra->getPriceExtra(),
        ];
        self::validateExtraData($data, $extra->getIdExtra());
        if (!$db->update(self::TABLE_NAME, $data, ['idExtra' => $extra->getIdExtra()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a extra from the database.
     *
     * @param int $idExtra The ID of the extra.
     * @return bool True if the extra was successfully deleted, otherwise False.
     */
    public static function delete(int $idExtra): bool {
        $db=FDatabase::getInstance();
        return $db->delete(self::TABLE_NAME, ['idExtra' => $idExtra]);
    }

    /**
     * Retrieves all extra items.
     *
     * @return EExtra[] An array of all EExtra objects.
     * @throws Exception If there is an error during the retrieval operation.
     */
    public function readAll(): array {
        try {
            $db = FDatabase::getInstance(); // Get the singleton instance
            $results = $db->loadMultiples(self::TABLE_NAME); // Use the loadMultiples method to load the data
            return array_filter(array_map([$this, 'arrayToEntity'], $results));
        } catch (Exception $e) {
            error_log(self::ERR_ALL_EXTRA . $e->getMessage());
            return [];
        }
    }

    /**
     * Checks if a extra exists in the database.
     *
     * @param int $idExtra The ID of the extra.
     * @return bool True if the extra exists, otherwise False.
     */
    public static function exists(string $idExtra): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idExtra' => $idExtra]);
    }

    /**
     * Validates the data for creating or updating an extra.
     *
     * @param array $data The data array containing 'name' and 'price'.
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateExtraData(array $data, ?int $currentId=null): void {
        // Validate 'name'
        if (empty($data['name']) || !is_string($data['name'])) {
            throw new Exception(self::ERR_NAME_FIELD);
        }
        //Checks for duplicates (exlude current ID if editing)
        $existing = self::readByName($data['name']);
        if ($existing !== null && $existing->getIdExtra()!==$currentId) {
            throw new Exception(self::ERR_DUPLICATE_EXTRA);
        }
        // Validate 'priceExtra'
        if (!isset($data['price']) || !is_numeric($data['price'])) {
            throw new Exception(self::ERR_NUMERIC_PRICE);
        }
        //Check for negative prices
        if ($data['price'] < 0) {
            throw new Exception(self::ERR_NEGATIVE_PRICE);
        }
    }
    
    /**
     * Creates an instance of EExtra from the given data.
     *
     * @param array $data The data array containing extra information.
     * @return EExtra The created EExtra object.
     * @throws Exception If required fields are missing.
     */
    public function arrayToEntity(array $data): EExtra {
        $requiredFields = ['idExtra', 'name', 'price'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EExtra(
            $data['idExtra'],
            $data['name'],
            $data['price']
        );
    }

    /**
     * Converts an EExtra object into an associative array for the database.
     *
     * @param EExtra $extra The extra object to convert.
     * @return array The extra data as an array.
     */
    public function entityToArray(EExtra $extra): array {
        return [
            'idExtra' => $extra->getIdExtra(),
            'name' => $extra->getNameExtra(),
            'price' => $extra->getPriceExtra()
        ];
    }
}