<?php
namespace Foundation;

use DateTime;
use Entity\EReview;
use Foundation\FUser;
use Exception;

/**
 * Class FReview
 * Handles CRUD and others operations for reviews in the database.
 */
class FReview {
    /**
     * Name of the table associated with the review entity in the database.
     */
    protected const TABLE_NAME = 'review';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_INVALID_USER = "Invalid or non-existing user.";
    protected const ERR_EMPTY_BODY = "Review body cannot be empty.";
    protected const ERR_INVALID_STARS = "Stars rating must be a number between 1 and 5.";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the review.';
    protected const ERR_RETRIVE_REVIEW ='Failed to retrive the inserted review.';
    protected const ERR_REVIEW_NOT_FOUND = 'The review does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_MISSING_ID= 'Unable to retrieve the ID of the inserted extra';
    protected const ERR_INSERT_REVIEW = 'The review you are trying to reply to was not found.';
    protected const ERR_ALL_REVIEWS = 'Error loading all Reviews';
    
    /**
     * Creates a new review in the database.
     *
     * @param EReview $review The review object to save.
     * @return int The ID of the saved record, or 0 if the save fails.
     * @throws Exception If there is an error during the create operation.
     */
    public function create(EReview $review): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($review);
        self::validateReviewData($data);
        try {
            //Review insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted review by number to get the assigned idReview
            $storedReview = $db->load(self::TABLE_NAME, 'idReview', $createdId);
            if ($storedReview === null) {
                throw new Exception(self::ERR_RETRIVE_REVIEW);
            }
            //Assign the retrieved ID to the object
            $review->setIdReview((int)$createdId);
            //Return the id associated with this review
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a review from the database by their ID.
     *
     * @param int $id The ID of the review to read.
     * @return EReview|null The review object if found, null otherwise.
     */
    public function read(int $idReview): ?EReview {
        $db = FDatabase::getInstance();
        $result = $db->load(static::TABLE_NAME, 'idReview', $idReview);
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**
     * Updates an existing review in the database.
     *
     * @param EReview $review The review object to update.
     * @return bool True if the update was successful, False otherwise.
     * @throws Exception If there is an error during the update operation.

     */
    public function update(EReview $review): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($review->getIdReview())) {
            throw new Exception(self::ERR_REVIEW_NOT_FOUND);
        }
        $data = [
            'idUser' => $review->getIdUser(),
            'stars' => $review->getStars(),
            'body' => $review->getBody(),
            'idReply' => $review->getIdReply()
        ];
        self::validateReviewData($data);
        if (!$db->update(self::TABLE_NAME, $data, ['idReview' => $review->getIdReview()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a review from the database by their ID.
     *
     * @param int $idReview The ID of the review to delete.
     * @return bool True if the deletion was successful, False otherwise.
     */
    public function delete(int $idReview): bool {
        $db = FDatabase::getInstance();
        return $db->delete(static::TABLE_NAME, ['idReview' => $idReview]);
    }

    /**
     * Associates a reply with a review by setting the reply ID.
     *
     * @param int $idReview The ID of the review to update.
     * @param int $idReply The ID of the reply to associate.
     * @return bool True if the update was successful.
     * @throws Exception If the review is not found.
     */
    public function addReplyToReview(int $idReview, int $idReply): bool {
        $review = $this->read($idReview);
        if (!$review) {
            throw new Exception(self::ERR_INSERT_REVIEW);
        }
        $review->setIdReply($idReply);
        return $this->update($review);
    }

    /**
     * Loads the review written by a specific user.
     *
     * @param int $idUser The ID of the user.
     * @return EReview|null The review if found, null otherwise.
     */
    public function readReviewByUserId(int $idUser): ?EReview {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'idUser', $idUser);
        return $result ? self::arrayToEntity($result) : null;
    }

    /**
     * Loads all reviews from the database.
     *
     * @return EReview[] An array of EReview objects or an empty array if none are found.
     */
    public function readAll(): array {
        try {
            $db = FDatabase::getInstance();
            $results = $db->loadMultiples(self::TABLE_NAME);
            $entities = array_filter(array_map([$this, 'arrayToEntity'], $results));

            // Ordina dalla più recente alla più vecchia
            usort($entities, function ($a, $b) {
                return $b->getCreationTime() <=> $a->getCreationTime();
            });

            return $entities;
        } catch (Exception $e) {
            error_log(self::ERR_ALL_REVIEWS . $e->getMessage());
            return [];
        }
    }


    /**
     * Checks if a review exists in the database based on a specific field.
     *
     * @param string $field The field to check (e.g., 'idUser', 'body').
     * @param mixed $value The value of the field.
     * @return bool True if it exists, False otherwise.
     */
    public static function exists(int $idReview): bool {
        $db = FDatabase::getInstance();
        $exists = $db->exists(self::TABLE_NAME, ['idReview' => $idReview]);
        return $exists;
    }

    /**
     * Validates the data for creating or updating a review.
     *
     * @param array $data The data array containing review information.
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateReviewData(array $data): void {
        // idUser must exist
        if (!isset($data['idUser']) || !FUser::exists($data['idUser'])) {
            throw new Exception(self::ERR_INVALID_USER);
        }
        // Body must not be empty
        if (empty($data['body']) || !is_string($data['body'])) {
            throw new Exception(self::ERR_EMPTY_BODY);
        }

        // Stars must be a number between 1 and 5
        if (!isset($data['stars']) || !is_numeric($data['stars']) || $data['stars'] < 1 || $data['stars'] > 5) {
            throw new Exception(self::ERR_INVALID_STARS);
        }
        //Controllo se l'utente abbia delle prenotazioni passate
        $pastReservation=new FReservation();
        $res=$pastReservation->readReservationsByUserId($data['idUser']);
        if(empty($res)) {
            throw new Exception("U can't write a review, needed past reservation before");
        }
    }

    /**
     * Creates an EReview entity from the provided data.
     *
     * @param array $data The data used to create the EReview object.
     * @return EReview The created review object.
     * @throws Exception If an error occurs during the creation of the entity.
     */
    public function arrayToEntity(array $data):EReview {
            $requiredFields = ['idUser', 'stars', 'body'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EReview(
            $data['idUser'],
            $data['idReview'],
            $data['stars'],
            $data['body'],
            new DateTime($data['creationTime']),
            $data['idReply'],
        );
    }

    /**
     * Converts an EReview object into an associative array for the database.
     *
     * @param EReview $review The review object to convert.
     * @return array The review data as an array.
     */
    private function entityToArray(EReview $review): array {
        return [
            'idUser' => $review->getIdUser(),
            'idReview' => $review->getIdReview(),
            'stars' => $review->getStars(),
            'body' => $review->getBody(),
            'creationTime' => $review->getCreationTime(),
            'idReply' => $review->getIdReply()
        ];
    }
}