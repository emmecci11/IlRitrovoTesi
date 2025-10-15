<?php

namespace Foundation;

use DateTime;
use Entity\ECreditCard;
use Exception;

/**
 * Class to manage credit card operations in the database.
 */
class FCreditCard {

    /**
     * Name of the table associated with the credit card entity in the database.
     */
    protected const TABLE_NAME = 'creditcard';

    /**
     * Return the constant TABLE_NAME
     * @return string the table name
     */
    public static function getTableName(): string {
    return static::TABLE_NAME;
    }

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const  ERR_INSERTION_FAILED = 'Error during the insertion of the credit card.';
    protected const ERR_RETRIVE_CARD='Failed to retrive the inserted credit card.';
    protected const  ERR_CARD_NOT_FOUND = 'The credit card does not exist for this user.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_LOADING= 'Error loading credit cards: ';
    protected const ERROR_EMPTY_FIELD = 'One or more required fields are empty.';
    protected const ERROR_INVALID_NUMBER = 'Invalid credit card number.';
    protected const ERROR_INVALID_EXPIRATION = 'Expiration date must be in the future.';
    protected const ERROR_INVALID_CVV = 'The CVV must be 3 or 4 digits.';
    protected const ERROR_INVALID_TYPE = 'Invalid credit card type.';
    protected const ERROR_DUPLICATE_CARD = 'This credit card is already registered for the user.';
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted credit card";
    protected const ERR_INVALID_USER = "Invalid user ID.";

    /**
     * Create an ECreditCard object in the database.
     *
     * @param ECreditCard $creditCard The ECreditCard object to create.
     * @return int $createdId, the id inserted in db 
     * @throws Exception If there is an error during the store operation.
     */
    public function create(ECreditCard $creditCard): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($creditCard);
        self::validateCreditCardData($data);
        try {
            //Card insertion
            if (!FUser::exists($creditCard->getIdUser())) {
            throw new Exception(self::ERR_INVALID_USER);
            }
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted card by number to get the assigned idCreditCard
            $storedCard = $db->load(self::TABLE_NAME, 'idCreditCard', $createdId);
            if ($storedCard === null) {
                throw new Exception(self::ERR_RETRIVE_CARD);
            }
            //Assign the retrieved ID to the object
            $creditCard->setIdCreditCard((int)$createdId);
            //Return the id associated with this card
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a specific credit card from the database by IDcard.
     *
     * @param int $idCreditCard The ID of the Card to read.
     * @return ECreditCard|null The CreditCard object if found, null otherwise.
     */
    public function read(int $idCreditCard): ?ECreditCard {
        $db=FDatabase::getInstance();
        $result=$db->load(self::TABLE_NAME, 'idCreditCard', $idCreditCard);
        return $result ? $this->arrayToEntity($result): null;
    }

    /**
     * Updates an ECreditCard object in the database.
     *
     * @param ECreditCard $creditCard The ECreditCard object to update.
     * @return bool True if the update was successful, false otherwise.
     * @throws Exception If there is an error during the update operation.
     */
    public static function update(ECreditCard $creditCard): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($creditCard->getIdCreditCard())) {
            throw new Exception(self::ERR_CARD_NOT_FOUND);
        }
        $data = [
            'holder' => $creditCard->getHolder(),
            'number' => $creditCard->getNumber(),
            'cvv' => $creditCard->getCvv(),
            'expiration' => $creditCard->getExpiration(),
            'type' => $creditCard->getType()
        ];
        self::validateCreditCardData($data);
        if (!$db->update(self::TABLE_NAME, $data, ['idCreditCard' => $creditCard->getIdCreditCard()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a credit card from the database.
     *
     * @param int $idCreditCard The ID of the user associated with the credit card.
     * @return bool True if the credit card was successfully deleted, otherwise False.
     */
    public static function delete(int $idCreditCard): bool {
        $db=FDatabase::getInstance();
        return $db->delete(self::TABLE_NAME, ['idCreditCard' => $idCreditCard]);
    }

    /**
     * Loads credit cards by user ID.
     *
     * @param int $idUser The ID of the user.
     * @return ECreditCard[] An array of ECreditCard objects.
     * @throws Exception If an error occurs during the loading of credit cards.
     */
    public static function readCreditCardsByUserId(int $idUser): array {
        $db = FDatabase::getInstance();
        try {
            $results = $db->fetchWhere(self::TABLE_NAME, ['idUser' => $idUser]);
            $istance=new self();
            return array_map(fn($row) => $istance->arrayToEntity($row), $results);

        } catch (Exception $e) {
            throw new Exception(self::ERR_LOADING . $e->getMessage());
        }
    }

    /**
     * Reads all Credit Card from the database.
     *
     * @return ECreditCard[] An array of EUser objects.
     */
    public function readAll(): array {
        $db = FDatabase::getInstance();
        $results = $db->fetchAllFromTable(static::TABLE_NAME);
        return array_map([$this, 'arrayToEntity'], $results);
    }

    /**
     * Masks a credit card number, showing only the last 4 digits.
     *
     * @param string $number The credit card number.
     * @return string The masked credit card number.
     */
    public static function maskCreditCardNumber(string $number): string {
        $visibleDigits = 4;
        $visiblePart = substr($number, -1 * $visibleDigits);
        $maskedPart = str_repeat('*', strlen($number) - $visibleDigits);
        return $maskedPart . $visiblePart;
    }

    /**
     * Checks if a credit card exists in the database for the given Card number.
     *
     * @param string $numberCard The number of the credit card.
     * @return bool True if the credit card exists, otherwise False.
     * @throws Exception If there is an error during the check operation.
     */
    public static function existsNumber(string $numberCard): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['number' => $numberCard]);
    }

    /**
     * Checks if a credit card exists in the database fot the given user ID
     * 
     * @param int the ID card to verify
     * @return bool true if the card exists, otherwise fale
     */
    public static function exists(int $idCreditCard): bool {
        $db=FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idCreditCard' => $idCreditCard]);
    }

    /**
     * Checks whether a credit card is expired based on its expiration date.
     *
     * @param string $expiration The expiration date in 'Y-m' format (e.g., '2025-09').
     * @return bool True if the card is expired, otherwise false.
     * @throws Exception If the expiration date format is invalid.
     */
    public static function isExpired(string $expiration): bool
    {
        $expirationDate = DateTime::createFromFormat('Y-m-d', $expiration);
        if (!$expirationDate) {
            throw new Exception(self::ERROR_INVALID_EXPIRATION);
        }

        // Cards typically expire at the end of the expiration month
        $expirationDate->modify('last day of this month')->setTime(23, 59, 59);
        $now = new DateTime();

        return $expirationDate < $now;
    }

    /**
     * Validates the credit card data before insertion.
     *
     * @param array $cardData Associative array with keys: number, expiration, cvv, type, holder, idUser
     * @throws Exception If validation fails
     */
    public static function validateCreditCardData(array $cardData): void
    {
        $requiredFields = ['number', 'expiration', 'cvv', 'type', 'holder', 'idUser'];
        foreach ($requiredFields as $field) {
            if (empty($cardData[$field])) {
                throw new Exception(self::ERROR_EMPTY_FIELD);
            }
        }
        // Check credit card number: only digits, 13-19 characters
        if (!preg_match('/^\d{13,19}$/', $cardData['number'])) {
            throw new Exception(self::ERROR_INVALID_NUMBER);
        }
        // Check expiration date format and ensure it's in the future (expected format: 'YYYY-MM')
        $expiration = DateTime::createFromFormat('Y-m-d', $cardData['expiration']);
        $current = new DateTime('first day of this month');
        if (!$expiration || $expiration < $current) {
            throw new Exception(self::ERROR_INVALID_EXPIRATION);
        }
        // Check CVV format: 3 or 4 digits
        if (!preg_match('/^\d{3,4}$/', $cardData['cvv'])) {
            throw new Exception(self::ERROR_INVALID_CVV);
        }
        // Check card type is allowed
        $allowedTypes = ['Visa', 'Mastercard', 'American Express', 'Maestro', 'V-Pay', 'PagoBANCOMAT'];
        if (!in_array($cardData['type'], $allowedTypes, true)) {
            throw new Exception(self::ERROR_INVALID_TYPE);
        }
        // Check if card already exists for the user
        if (self::exists($cardData['number'])) {
            throw new Exception(self::ERROR_DUPLICATE_CARD);
        }
    }

    /**
     * Creates an instance of ECreditCard from the given data.
     *
     * @param array $data The data array containing credit card information.
     * @return ECreditCard The created ECreditCard object.
     * @throws Exception If required fields are missing.
     */
    public function arrayToEntity(array $data): ECreditCard {
        $requiredFields = ['idCreditCard', 'idUser', 'number', 'expiration', 'cvv', 'type', 'holder'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new ECreditCard(
            $data['idCreditCard'],
            $data['holder'],
            $data['number'],
            $data['cvv'],
            new DateTime($data['expiration']),
            $data['type'],
            $data['idUser']
        );
    }

    /**
     * Converts an ECreditCard object into an associative array for the database.
     *
     * @param ECreditCard $creditCard The credit card object to convert.
     * @return array The credit card data as an array.
     */
    public function entityToArray(ECreditCard $creditCard): array {
        return [
            'idCreditCard' => $creditCard->getIdCreditCard(),
            'idUser' => $creditCard->getIdUser(),
            'number' => $creditCard->getNumber(),
            'expiration' => $creditCard->getExpiration(),
            'cvv' => $creditCard->getCvv(),
            'type' => $creditCard->getType(),
            'holder' => $creditCard->getHolder()
        ];
    }
}