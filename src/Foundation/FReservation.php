<?php

namespace Foundation;

use DateTime;
use Entity\EReservation;
use Foundation\FUser;
use Entity\TimeFrame;
use Exception;
use Smarty\Data;

/**
 * Class FReservation represents a reservation entity.
 *
 * @package Foundation
 */
class FReservation {
    /**
     * Name of the table associated with the reservation entity in the database.
     */
    protected const TABLE_NAME = 'reservation';

    // Valid reservation timeframes allowed in the system
    protected const VALID_TIMEFRAMES = ['lunch', 'dinner'];
    
    // array containing the possible states of a reservation
    private const VALID_STATES = ['confirmed', 'approved', 'pending', 'canceled'];

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_INVALID_USER = 'Invalid or non-existing user.';
    protected const ERR_INVALID_LOCATION = 'Either idTable or idRoom must be set, but not both.';
    protected const ERR_INVALID_DATE = 'Reservation date is invalid or not in the future.';
    protected const ERR_INVALID_TIMEFRAME = 'Timeframe is not valid.';
    protected const ERR_NEGATIVE_PRICE = 'Total price cannot be negative.';
    protected const ERR_INVALID_PEOPLE = 'Number of people must be greater than zero.';
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the resrvation.';
    protected const ERR_RETRIVE_RES='Failed to retrive the inserted reservation.';
    protected const ERR_RES_NOT_FOUND = 'The reservation does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Error during the update operation.';
    protected const ERR_MISSING_ID= 'Unable to retrieve the ID of the inserted reservation.';
    protected const ERR_CONVERT_EXTRA = 'Cannot convert extras: idReservation is null.';
    protected const ERR_INSERT_EXTRA = 'Failed to insert extra in reservation_extra.';
    protected const ERR_DELETE_EXTRA = 'It was not possible to delete the extras associated with the reservation.';
    protected const ERR_DELETE_RESERVATION = 'Error during the cancellation of the reservation.';
    protected const ERR_ID_ROOM_NOT_FOUND = 'Room not found for idRoom = ';

    /**
     * Create a new reservation in the database.
     *
     * @param EReservation $reservation The reservation to store.
     * @return int The ID of the newly inserted reservation.
     * @throws Exception If an error occurred during the insertion.
     */
    public function create(EReservation $reservation): int {
        $db = FDatabase::getInstance();
        // Calculate the total price
        $totPrice = $this->calculateTotalReservationPrice($reservation);
        $reservation->setTotPrice($totPrice);
        $data = $this->entityToArray($reservation);
        self::validateReservationData($data);
        try {
            // Begin transaction
            $db->beginTransaction();
            // Lock of the table reservation
            if ($reservation->getIdRoom() !== null) {
                // Lock rows related to the room to prevent concurrent double bookings
                $sql = "SELECT idReservation FROM " . self::TABLE_NAME . " WHERE idRoom = ? FOR UPDATE";
                $stmt = $db->prepare($sql);
                $stmt->execute([$reservation->getIdRoom()]);
            } else {
                // If idRoom is null, lock of all the table
                $sql = "SELECT idReservation FROM " . self::TABLE_NAME . " FOR UPDATE";
                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
            // Insert reservation
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            // Retrive ID
            $createdId = $db->getLastInsertedId();
            if ($createdId === null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            // If this is a Room Reservation, we check for extras
            if ($reservation->getIdRoom() !== null) {
                $reservation->setIdReservation((int)$createdId);
                $this->createExtrasInReservation($reservation);
            }
            // Retrive the last inserted reservation
            $storedReservation = $db->load(self::TABLE_NAME, 'idReservation', $createdId);
            if ($storedReservation === null) {
                throw new Exception(self::ERR_RETRIVE_RES);
            }
            // Set ID
            $reservation->setIdReservation((int)$createdId);
            // Commit transaction
            $db->commit();
            return (int)$createdId;
        } catch (Exception $e) {
            // Rollback if an error occurs
            $db->rollback();
            throw $e;
        }
    }

    /**
     * Associates a list of extras with a given reservation by inserting entries into the
     * reservation_extra many-to-many relationship table.
     *
     * @param EReservation $reservation The reservation entity (must have ID and extras).
     * @throws Exception If insertion fails.
     */
    public function createExtrasInReservation(EReservation $reservation): void {
        $db = FDatabase::getInstance();
        $extrasData = $this->entityToExtrasArray($reservation);

        foreach ($extrasData as $data) {
            $result = $db->insert('extrainreservation', $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERT_EXTRA);
            }
        }
    }

    /**
     * Reads a reservation from the database by their ID, including associated extras
     * only if the reservation has an associated room.
     *
     * @param int $idReservation The ID of the reservation to read.
     * @return EReservation|null The reservation object if found, null otherwise.
     */
    public function read(int $idReservation): ?EReservation {
        $db = FDatabase::getInstance();
        // Loads the reservation data
        $result = $db->load(static::TABLE_NAME, 'idReservation', $idReservation);
        if (!$result) {
            return null;
        }
        // Converts in Entity
        $reservation = $this->arrayToEntity($result);
        // Loads the extras only if this is a room reservation
        $this->readExtrasInReservation($reservation);
        return $reservation;
    }

    /**
     * Read the extras associated to a Reservation
     */
    public function readExtrasInReservation(EReservation $reservation): void {
    //Controllo se c'è una stanza prenotata
    if ($reservation->getIdRoom() === null) {
        return;
    }

    $db = FDatabase::getInstance();
    $reservationExtraRows = $db->loadMultiples('extrainreservation', ['idReservation' => $reservation->getIdReservation()]);
    $idExtras = array_column($reservationExtraRows, 'idExtra');

    if (!empty($idExtras)) {
        $extraRows = $db->fetchWhereIn('extra', 'idExtra', $idExtras);
        $extras = $this->extrasArrayToEntity($extraRows);
        $reservation->setExtras($extras);
    }
}

    /**
     * Updates an existing reservation in the database, including its extras if applicable.
     *
     * @param EReservation $reservation The reservation to update.
     * @return bool True if the update was successful.
     * @throws Exception If an error occurs during the update process.
     */
    public function update(EReservation $reservation): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($reservation->getIdReservation())) {
            throw new Exception(self::ERR_RES_NOT_FOUND);
        }
        // We calculate again the total price with the new informations
        $totPrice = $this->calculateTotalReservationPrice($reservation);
        $reservation->setTotPrice($totPrice);
        $data = [
            'idUser' => $reservation->getIdUser(),
            'reservationDate' => $reservation->getReservationDate(),
            'timeFrame' => $reservation->getReservationTimeFrame(),
            'state' => $reservation->getState(),
            'totPrice' => $reservation->getTotPrice(),
            'people' => $reservation->getPeople(),
            'comment' => $reservation->getComment(),
            'idTable' => $reservation->getIdTable(),
            'idRoom' => $reservation->getIdRoom()
        ];
        self::validateReservationData($data);
        if (!$db->update(self::TABLE_NAME, $data, ['idReservation' => $reservation->getIdReservation()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        // Updates the extra only if this is a room reservation.
        if ($reservation->getIdRoom() !== null) {
            $this->updateExtrasInReservation($reservation);
        }
        return true;
    }

    /**
     * Updates the extras associated with a reservation.
     * Deletes existing links and inserts the new ones.
     *
     * @param EReservation $reservation
     * @throws Exception If deletion or insertion fails.
     */
    private function updateExtrasInReservation(EReservation $reservation): void {
        $db = FDatabase::getInstance();

        // Deletes all the previous associations.
        if (!$db->delete('extrainreservation', ['idReservation' => $reservation->getIdReservation()])) {
            throw new Exception(self::ERR_DELETE_EXTRA);
        }
        // Inserts the new associations
        $extrasData = $this->entityToExtrasArray($reservation);
        foreach ($extrasData as $data) {
            if ($db->insert('extrainreservation', $data) === null) {
                throw new Exception(self::ERR_INSERT_EXTRA);
            }
        }
    }

    /**
     * Deletes a reservation by its ID, including its associated extras
     * only if the reservation has an associated room.
     *
     * @param int $idReservation The ID of the reservation to delete.
     * @return bool True if the deletion was successful, false otherwise.
     * @throws Exception If the deletion of extras or the reservation fails.
     */
    public function delete(int $idReservation): bool {
        $db = FDatabase::getInstance();
        // Loads the reservation to check idRoom
        $result = $db->load(self::TABLE_NAME, 'idReservation', $idReservation);
        if (!$result) {
            throw new Exception(self::ERR_RES_NOT_FOUND);
        }
        $reservation = $this->arrayToEntity($result);
        // If this is a room reservation, we delete the possible extras associated with the reservation
        if ($reservation->getIdRoom() !== null) {
            $deletedExtras = $db->delete('extrainreservation', ['idReservation' => $idReservation]);
            if (!$deletedExtras) {
                throw new Exception(self::ERR_DELETE_EXTRA);
            }
        }
        // Deletes the reservation
        $deletedReservation = $db->delete(self::TABLE_NAME, ['idReservation' => $idReservation]);
        if (!$deletedReservation) {
            throw new Exception(self::ERR_DELETE_RESERVATION);
        }
        return true;
    }

    /**
     * Gets reservations for a given user ID.
     *
     * @param int $userId The ID of the user.
     * @return EReservation[] An array of reservations.
     * @throws Exception If an error occurs during the database operation.
     */
    public function readReservationsByUserId(int $userId): array {
        $db = FDatabase::getInstance();
        $result = $db->fetchWhere(self::TABLE_NAME, ['idUser' => $userId]);
        $reservations = [];
        foreach ($result as $row) {
            $reservation= $this->arrayToEntity($row);
            $this->readExtrasInReservation($reservation);
            $reservations[]=$reservation;
        }
        return $reservations;
    }

    /**
     * Gets all the past reservations given user ID
     * 
     * @param int $idUser
     * @return EReservation[] An array of reservations
     * @throws Exception If an error occurs
     */
    public function readPastReservationsByUserId($idUser) {
        $allReservations=$this->readReservationsByUserId($idUser);
        $pastReservations=[];
        $today=new DateTime();

        foreach ($allReservations as $reservation) {
            $reservationDate=new DateTime($reservation->getReservationDate());
            if($reservationDate<$today) {
                $pastReservations[]=$reservation;
            }
        }
        return $pastReservations;
    }

    /**
     * Gets all the future reservations given user ID
     * 
     * @param int $idUser
     * @return EReservation[] An array of reservations
     * @throws Exceprion If an error occours
     */
    public function readFutureReservationsByUserId($idUser) {
        $allReservations=$this->readReservationsByUserId($idUser);
        $futureReservations=[];
        $today=new DateTime();

        foreach ($allReservations as $reservation) {
            $reservationDate=new DateTime($reservation->getReservationDate());
            if($reservationDate>=$today) {
                $futureReservations[]=$reservation;
            }
        }
        return $futureReservations;
    }

    /**
     * Gets reservations for a specific table.
     *
     * @param int $idTable The ID of the table.
     * @return EReservation[] An array of EReservation objects associated with the table.
     * @throws Exception If there is an error during the retrieval operation.
     */
    public function readReservationsByTableId(int $tableId): array {
        $db = FDatabase::getInstance();
        $result = $db->fetchWhere(self::TABLE_NAME, ['idTable' => $tableId]);
        $reservations = [];
        foreach ($result as $row) {
            $reservation= $this->arrayToEntity($row);
            $this->readExtrasInReservation($reservation);
            $reservations[]=$reservation;
        }
        return $reservations;
    }

    /**
     * Gets reservations for a specific room.
     *
     * @param int $roomId The ID of the room.
     * @return EReservation[] An array of EReservation objects associated with the room.
     * @throws Exception If there is an error during the retrieval operation.
     */
    public function readReservationsByRoom(int $roomId): array {
        $db = FDatabase::getInstance();
        $result = $db->fetchWhere(self::TABLE_NAME, ['idRoom' => $roomId]);
        $reservations = [];
        foreach ($result as $row) {
            $reservation= $this->arrayToEntity($row);
            $this->readExtrasInReservation($reservation);
            $reservations[]=$reservation;
        }
        return $reservations;
    }

    /**
     * Checks if a reservation exists in the database.
     *
     * @param int $idReservation The ID of the reservation.
     * @return bool True if the reservation exists, otherwise False.
     */
    public static function exists(string $idReservation): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idReservation' => $idReservation]);
    }

    /**
     * Reads all Reservations from the database.
     *
     * @return EReservation[] An array of EUser objects.
     */
    public function readAll(): array {
        $db = FDatabase::getInstance();
        $results = $db->fetchAllFromTable(static::TABLE_NAME);
        return array_map([$this, 'arrayToEntity'], $results);
    }

    /**
     * Validates the data for creating or updating a reservation.
     *
     * @param array $data The data array containing reservation info.
     *
     * @throws Exception If required fields are missing or invalid.
     */
    public static function validateReservationData(array $data): void {
        // idUser must exist
        if (!isset($data['idUser']) || !is_int($data['idUser']) || !FUser::exists($data['idUser'])) {
            throw new Exception(self::ERR_INVALID_USER);
        }
        //Check if idRoom and idTable are not the same equal
        $hasTable = array_key_exists('idTable', $data) && $data['idTable'] !== null;
        $hasRoom = array_key_exists('idRoom', $data) && $data['idRoom'] !== null;
        if ($hasTable === $hasRoom) { // entrambi true o entrambi false
            throw new Exception(self::ERR_INVALID_LOCATION);
        }
        // Reservation date must be valid and in the future (allow booking same day for evening)
        if (!isset($data['reservationDate']) || !self::isValidFutureDate($data['reservationDate'])) {
            throw new Exception(self::ERR_INVALID_DATE);
        }
        // Timeframe must be one of the allowed values
        if (!isset($data['timeFrame']) || !in_array($data['timeFrame'], self::VALID_TIMEFRAMES, true)) {
            throw new Exception(self::ERR_INVALID_TIMEFRAME);
        }
        // Total price cannot be negative
        if (!isset($data['totPrice']) || !is_numeric($data['totPrice']) || $data['totPrice'] < 0) {
            throw new Exception(self::ERR_NEGATIVE_PRICE);
        }
        // People must be set and greater than zero
        if (!isset($data['people']) || !is_int($data['people']) || $data['people'] <= 0) {
            throw new Exception(self::ERR_INVALID_PEOPLE);
        }
        // State must be one of the allowed values
        if (!isset($data['state']) || !in_array($data['state'], self::VALID_STATES, true)) {
            throw new Exception("Invalid reservation state");
        }
    }

    /**
     * Function to retrive avalibles tables from db
     * 
     * @param string $reservationDate
     * @param Enum $time Frame
     * @param int $guests
     */
    public function getAvaliableTables(string $reservationDate, string $timeFrame, int $guests): array {
        $db=FDatabase::getInstance();
        $avalibleTables=$db->getAvailableTables($reservationDate, $timeFrame, $guests);
        return $avalibleTables;
    }

    /**
     * Function to retrive avaliables rooms from db
     * 
     * @param string $reservationDate
     * @param Enum $time Frame
     * @param int $guests
     */
    public function getAvailableRooms(string $reservationDate, string $timeFrame, int $guests): array {
        $db=FDatabase::getInstance();
        $availableRooms=$db->getAvailableRooms($reservationDate, $timeFrame, $guests);
        return $availableRooms;
    }

    /**
     * Updates the state of a reservation.
     *
     * @param int $idReservation The ID of the reservation.
     * @param string $newState The new state.
     * @return bool True if the update was successful, false otherwise.
     * @throws Exception If an error occurs during the update.
     */
    private static function updateStateReservation(int $idReservation, string $newState): bool {
        $db = FDatabase::getInstance();
        // Update the reservation status
        return $db->update(
            self::TABLE_NAME, // Table name
            ['state' => 'cancelled'], // Data to update
            ['idReservation' => $idReservation] // WHERE condition
        );
    }

    /**
     * Checks if the date is valid and in the future (today or later, allowing same-day evening bookings).
     *
     * @param string $date Date string in 'Y-m-d' format (adjust if needed)
     * @return bool
     */
    private static function isValidFutureDate(string $date): bool {
        $now = new DateTime('now');
        $resDate = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        if (!$resDate) {
            return false;
        }
        // Date must be today or later (time set to midnight for comparison)
        return $resDate >= $now->setTime(0,0,0);
    }

    /**
     * Calculates the total price of a reservation, including extras and room tax if applicable.
     *
     * @param EReservation $reservation The reservation object.
     * @return float The total price to be paid for the reservation.
     * @throws Exception If room data is missing or invalid.
     */
    private function calculateTotalReservationPrice(EReservation $reservation): float {
        $total = $reservation->calculateTotPriceFromExtras();
        if ($reservation->getIdRoom() !== null) {
            // Reetrives the room to obtain $tax
            $fRoom = new FRoom();
            $room = $fRoom->read($reservation->getIdRoom());
            if ($room === null) {
                throw new Exception(self::ERR_ID_ROOM_NOT_FOUND . $reservation->getIdRoom());
            }
            $tax = $room->getTax(); // Supponendo che questo metodo esista in ERoom
            $total += $tax;
        }

        return $total;
    }

    /**
     * Creates an EReservation entity directly from provided data.
     *
     * @param array $data An associative array containing reservation details.
     * @return EReservation The created EReservation object.
     * @throws Exception If required fields are missing or invalid.
     */
    public function arrayToEntity(array $data): EReservation {
        $requiredFields = ['reservationDate', 'timeFrame', 'state', 'totPrice', 'people'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EReservation(
            $data['idReservation'] ?? null,
            $data['idUser'] ?? null,
            $data['idTable'] ?? null,
            $data['idRoom'] ?? null,
            new DateTime($data['creationTime']) ?? null,
            new DateTime($data['reservationDate']) ?? null,
            isset($data['timeFrame']) ? TimeFrame::Tryfrom($data['timeFrame']) : null,
            $data['state'] ?? null,
            $data['people'] ?? null,
            $data['comment'] ?? null,
            [],
            $data['totPrice'] ?? null,
        );
    }

    /**
     * Converts an EReservation object into an associative array for the database.
     *
     * @param EReservation $reservation The review object to convert.
     * @return array The reservation data as an array.
     */
    public function entityToArray(EReservation $reservation): array {
        return [
            'idReservation' => $reservation->getIdReservation(),
            'idUser' => $reservation->getIdUser(),
            'idTable' => $reservation->getIdTable(),
            'idRoom' => $reservation->getIdRoom(),
            'creationTime' => $reservation->getCreationTime(),
            'reservationDate' => $reservation->getReservationDate(),
            'timeFrame' => $reservation->getReservationTimeFrame(),
            'state' => $reservation->getState(),
            'people' => $reservation->getPeople(),
            'comment' => $reservation->getComment(),
            'totPrice' => $reservation->getTotPrice(),
        ];
    }

    /**
     * Converts the extras of a reservation to an array format suitable for DB insertion in extrainreservation.
     *
     * @param EReservation $reservation The reservation entity.
     * @return array An array of associative arrays, each with 'idReservation' and 'idExtra'.
     */
    private function entityToExtrasArray(EReservation $reservation): array {
        $result = [];
        $extras = $reservation->getExtras();
        $idReservation = $reservation->getIdReservation();
        if ($idReservation === null) {
            throw new Exception(self::ERR_CONVERT_EXTRA);
        }
        foreach ($extras as $extra) {
            $result[] = [
                'idReservation' => $idReservation,
                'idExtra' => $extra->getIdExtra()
            ];
        }
        return $result;
    }

    /**
     * Converts DB rows from extrainreservation into an array of EExtra entities.
     *
     * @param array $rows The result rows from extrainreservation joined with extra.
     * @return array Array of EExtra entities.
     */
    private function extrasArrayToEntity(array $rows): array {
        $extras = [];
        foreach ($rows as $row) {
            // Qui puoi usare un costruttore minimale se hai solo idExtra
            $extras[] = new \Entity\EExtra(
                $row['idExtra'],
                $row['name'] ?? null,
                $row['price'] ?? null
            );
        }
        return $extras;
    }
}