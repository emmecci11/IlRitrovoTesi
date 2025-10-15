<?php
namespace Foundation;

use DateTime;
use Entity\EReply;
use Exception;

/**
 * Class FReply
 * Handles CRUD and others operations for replies to reviews in the database.
 */
class FReply {
    /**
     * Name of the table associated with the reply entity in the database.
     */
    protected const TABLE_NAME = 'reply';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_EMPTY_BODY = "The filed body cannot be empty";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the reply.';
    protected const ERR_RETRIVE_REPLY='Failed to retrive the inserted reply.';
    protected const ERR_REPLY_NOT_FOUND = 'The reply does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted reply";

    /**
     * Creates a new reply in the database.
     *
     * @param EReply $reply The reply object to save.
     * @return int The ID of the saved record, or 0 if the save fails.
     * @throws Exception If there is an error during the store operation.
     */
    public function create(EReply $reply): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($reply);
        self::validateReplyData($data);
        try {
            //Reply insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $idInserito=$db->getLastInsertedId();
            if ($idInserito==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted reply by number to get the assigned idExtra
            $storedReply = $db->load(self::TABLE_NAME, 'idReply', $idInserito);
            if ($storedReply === null) {
                throw new Exception(self::ERR_RETRIVE_REPLY);
            }
            //Assign the retrieved ID to the object
            $reply->setIdReply((int)$idInserito);
            //Return the id associated with this reply
            return (int)$idInserito;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a reply from the database by their ID.
     *
     * @param int $idReply The ID of the reply to read.
     * @return EReply|null The reply object if found, null otherwise.
     */
    public function read(int $idReply): ?EReply {
        $db = FDatabase::getInstance();
        $result = $db->load(static::TABLE_NAME, 'idReply', $idReply);
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**
     * Updates an existing reply in the database.
     *
     * @param EReply $reply The reply object to update.
     * @return bool True if the update was successful, False otherwise.
     * @throws Exception If there is an error during the update operation.
     */
    public function update(EReply $reply): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($reply->getIdReply())) {
            throw new Exception(self::ERR_REPLY_NOT_FOUND);
        }
        $data = [
            'dateReply' => $reply->getDateReply(),
            'body'=> $reply->getBody(),
        ];
        self::validateReplyData($data);
        if (!$db->update(self::TABLE_NAME, $data, ['idReply' => $reply->getIdReply()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a reply from the database by their ID.
     *
     * @param int $idReply The ID of the reply to delete.
     * @return bool True if the deletion was successful, False otherwise.
     */
    public function delete(int $idReply): bool {
        $db = FDatabase::getInstance();
        return $db->delete(static::TABLE_NAME, ['idReply' => $idReply]);
    }

    /**
     * Checks if a reply exists in the database based on a specific field.
     *
     * @param int $idReply the ID of the reply to check.
     * @return bool True if it exists, False otherwise.
     */
    public static function exists(int $idReply): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idReply' => $idReply]);

    }

    /**
     * Reads all Reply from the database.
     *
     * @return EReply[] An array of EUser objects.
     */
    public function readAll(): array {
        $db = FDatabase::getInstance();
        $results = $db->fetchAllFromTable(static::TABLE_NAME);
        return array_map([$this, 'arrayToEntity'], $results);
    }

    /**
     * Validates the data for creating or updating a reply.
     *
     * @param array $data The data array containing 'body'.
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateReplyData(array $data): void {
        // Validate 'body' (non deve essere vuoto)
        if (!isset($data['body']) || !is_string($data['body']) || trim($data['body']) === '') {
            throw new Exception(self::ERR_EMPTY_BODY);
        }
    }

    /**
     * Converts an associative array into an instance of EReply.
     *
     * @param array $data Associative array with keys 'idReply', 'dateReply', and 'body'
     * @return EReply The resulting EReply entity.
     * @throws Exception If any required field is missing.
     */
    public function arrayToEntity(array $data): EReply {
            $requiredFields = ['idReply', 'dateReply', 'body'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EReply(
            $data['idReply'] ?? null,
            new DateTime($data['dateReply'])?? null,
            $data['body'] ?? null
        );
    }

    /**
     * Converts an EReply object into an associative array for the database.
     *
     * @param EReply $reply The reply object to convert.
     * @return array The reply data as an array.
     */
    public function entityToArray(EReply $reply): array {
        return [
            'idReply' => $reply->getIdReply(),
            'dateReply' => $reply->getDateReply(),
            'body' => $reply->getBody(),
        ];
    }
}