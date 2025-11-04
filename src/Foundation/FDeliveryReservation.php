<?php
namespace Foundation;

use Entity\EDeliveryReservation;
use DateTime;
use Exception;

/**
 * Class FDeliveryReservation to manage Delivery Reservations in the database.
 */
class FDeliveryReservation {

    /**
     * Name of the table associated with the delivery reservation entity in the database.
     */
    protected const TABLE_NAME = 'deliveryreservation';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_ID_DELIVERY_RESERVATION="The 'idDeliveryReservation' field is required and must be an integer.";
    protected const ERR_USER_ID="The 'idUser' field is required and must be an integer.";
    protected const ERR_USER_PHONE="The 'userPhone' field is required and must be a string.";
    protected const ERR_USER_ADDRESS="The 'userAddress' field is required and must be a string.";
    protected const ERR_USER_NUMBER_ADDRESS="The 'userNumberAddress' field is required and must be an integer.";
    protected const ERR_WISHED_TIME="The 'wishedTime' field is required and must be a valid DateTime object.";
    protected const ERR_MISSING_ID= "Unable to retrieve the ID of the inserted delivery reservation";
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the delivery reservation.';
    protected const ERR_RETRIVE_DELIVERY_RESERVATION='Failed to retrive the inserted delivery reservation.';
    protected const ERR_DELIVERY_RESERVATION_NOT_FOUND = 'The delivery reservation does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_ALL_DELIVERY_RESERVATIONS = 'Error loading all delivery reservations: ';
    protected const ERR_USER_NOT_FOUND='User not found for this delivery reservation';

    /**
     * Create a Delivery Reservation in the database.
     *
     * @param EDeliveryReservation $deliveryReservation The EDeliveryReservation object to store.
     * @return bool True if the operation was successful, otherwise False.
     * @throws Exception If there is an error during the create operation.
     */
    public function create(EDeliveryReservation $deliveryReservation): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($deliveryReservation);
        self::validateDeliveryReservationData($data, $deliveryReservation->getIdUser());
        try {
            // Delivery Reservation insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            // Retrieve the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            // Retrive the inserted delivery reservation by number to get the assigned idDeliveryReservation
            $storedDeliveryReservation = $db->load(self::TABLE_NAME, 'idDeliveryReservation', $createdId);
            if ($storedDeliveryReservation === null) {
                throw new Exception(self::ERR_RETRIVE_DELIVERY_RESERVATION);
            }
            // Assign the retrieved ID to the object
            $deliveryReservation->setIdDeliveryReservation((int)$createdId);
            // Return the id associated with this delivery reservation
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a specific Delivery Reservation from the database by ID.
     *
     * @param int $idDeliveryReservation The ID of the Delivery Reservation to read.
     * @return EDeliveryReservation|null The Delivery Reservation object if found, null otherwise.
     */
    public function read(int $idDeliveryReservation): ?EDeliveryReservation {
        $db=FDatabase::getInstance();
        $result=$db->load(self::TABLE_NAME, 'idDeliveryReservation', $idDeliveryReservation);
        return $result ? $this->arrayToEntity($result): null;
    }

    /**
     * Deletes a Delivery Reservation from the database.
     *
     * @param int $idDeliveryReservation The ID of the Delivery Reservation.
     * @return bool True if the Delivery Reservation was successfully deleted, otherwise False.
     */
    public static function delete(int $idDeliveryReservation): bool {
        $db=FDatabase::getInstance();
        return $db->delete(self::TABLE_NAME, ['idDeliveryReservation' => $idDeliveryReservation]);
    }

    /**
     * Retrieves all Delivery Reservations.
     *
     * @return EDeliveryReservation[] An array of all Delivery Reservation objects.
     * @throws Exception If there is an error during the retrieval operation.
     */
    public function readAll(): array {
        try {
            $db = FDatabase::getInstance(); // Get the singleton instance
            $results = $db->loadMultiples(self::TABLE_NAME); // Use the loadMultiples method to load the data
            return array_filter(array_map([$this, 'arrayToEntity'], $results));
        } catch (Exception $e) {
            error_log(self::ERR_ALL_DELIVERY_RESERVATIONS . $e->getMessage());
            return [];
        }
    }

    /**
     * Restituisce tutte le prenotazioni di tipo delivery associate a un utente.
     *
     * @param int $idUser
     * @return EDeliveryReservation[] Array di oggetti EDeliveryReservation
     */
    public static function readAllDeliveryByUser(int $idUser): array {
        $db = FDatabase::getInstance();
        $rows = $db->fetchDeliveryReservationsByUser($idUser);
        $reservations = [];
        foreach ($rows as $row) {
            $reservation = new \Entity\EDeliveryReservation(
                $row['idDeliveryReservation'],
                $row['idUser'],
                $row['userPhone'],
                $row['userAddress'],
                $row['userNumberAddress'],
                new \DateTime($row['wishedTime'])
            );
            $reservations[] = $reservation;
        }
        return $reservations;
    }

    /**
     * Checks if a Delivery Reservation exists in the database.
     *
     * @param int $idDeliveryReservation The ID of the Delivery Reservation.
     * @return bool True if the Delivery Reservation exists, otherwise False.
     */
    public static function exists(int $idDeliveryReservation): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idDeliveryReservation' => $idDeliveryReservation]);
    }

    /**
     * Validates the data for creating or updating a Delivery Reservation.
     *
     * @param array $data The data array containing 'idUser', 'userPhone', 'userAddress', and 'wishedTime'.
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateDeliveryReservationData(array $data, ?int $currentId=null): void {
    // Validazione campi obbligatori esistenti
        if (!isset($data['idDeliveryReservation']) || !is_int($data['idDeliveryReservation'])) {
            throw new Exception(self::ERR_ID_DELIVERY_RESERVATION);
        }  
        if (!isset($data['idUser']) || !is_int($data['idUser'])) {
            throw new Exception(self::ERR_USER_ID);
        } elseif (!FUser::exists((string)$data['idUser'])) {
            throw new Exception(self::ERR_USER_NOT_FOUND);
        }
        if (empty($data['userPhone']) || !is_string($data['userPhone'])) {
            throw new Exception(self::ERR_USER_PHONE);
        }
        if (empty($data['userAddress']) || !is_string($data['userAddress'])) {
            throw new Exception(self::ERR_USER_ADDRESS);
        }
        if (!isset($data['userNumberAddress']) || !is_int($data['userNumberAddress'])) {
            throw new Exception(self::ERR_USER_NUMBER_ADDRESS);
        }

        // WishedTime: accettiamo sia stringa sia DateTime
        if (!isset($data['wishedTime'])) {
            throw new Exception(self::ERR_WISHED_TIME);
        }

        $wishedTime = $data['wishedTime'] instanceof DateTime 
                  ? $data['wishedTime'] 
                  : new DateTime($data['wishedTime']);

        $now = new DateTime();
        $maxDate = (clone $now)->modify('+2 days');

        // Controllo che la data non sia oltre i 2 giorni
        if ($wishedTime > $maxDate) {
            throw new Exception("Orders can't be no longer then 2 days.");
        }

        // Controllo dell'orario: tra le 08:00 e le 00:00
        $hour = (int)$wishedTime->format('H');
        if ($hour < 8 || $hour > 23) { // 23 = 23:59 massimo
            throw new Exception("Sorry, we accept order only from 8AM-12PM");
        }
    }

    /**
     * Creates an instance of EDeliveryReservation from the given data.
     *
     * @param array $data The data array containing Delivery Reservation information.
     * @return EDeliveryReservation The created Delivery Reservation object.
     * @throws Exception If required fields are missing.
     */
    public function arrayToEntity(array $data): EDeliveryReservation {
        return new EDeliveryReservation(
            isset($data['idDeliveryReservation']) ? (int)$data['idDeliveryReservation'] : null,
            isset($data['idUser']) ? (int)$data['idUser'] : null,
            $data['userPhone'],
            $data['userAddress'],
            $data['userNumberAddress'],
            new DateTime($data['wishedTime'])
        );
    }

    /**
     * Converts a Delivery Reservation object into an associative array for the database.
     *
     * @param EDeliveryReservation $deliveryReservation The delivery reservation object to convert.
     * @return array The delivery reservation data as an array.
     */
    public function entityToArray(EDeliveryReservation $deliveryReservation): array {
        return [
            'idDeliveryReservation' => $deliveryReservation->getIdDeliveryReservation(),
            'idUser' => $deliveryReservation->getIdUser(),
            'userPhone' => $deliveryReservation->getUserPhone(),
            'userAddress' => $deliveryReservation->getUserAddress(),
            'userNumberAddress' => $deliveryReservation->getUserNumberAddress(),
            'wishedTime' => $deliveryReservation->getWishedTime()->format('Y-m-d H:i:s')
        ];
    }

}