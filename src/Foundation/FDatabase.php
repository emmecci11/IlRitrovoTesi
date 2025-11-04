<?php

namespace Foundation;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Class FDatabase
 * Manages the database connection and queries.
 */
class FDatabase {
    private static ?FDatabase $instance = null;
    private ?PDO $connection = null;

    /**
     * FDatabase constructor.
     * Private constructor to implement the Singleton pattern
     *
     * @throws Exception If the database connection fails
     */
    private function __construct() {
        try {
            // Include the config file
            require_once __DIR__ . '/../../config.php';

            // Create a new PDO instance
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connessione al database fallita: " . $e->getMessage());
        }
    }

    /**
     * Returns the singleton instance of FDatabase.
     *
     * @return FDatabase The instance of FDatabase.
     */
    public static function getInstance(): FDatabase {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Closes the database connection.
     */
    public function closeDbConnection(): void {
        $this->connection = null;
        self::$instance = null;
    }

    /**
     * Begin transaction.
     *
     * @return bool True on success, false on failure.
     */
    public function beginTransaction(): bool {
        try {
            return $this->connection->beginTransaction();
        } catch (PDOException $e) {
            error_log("Errore durante l'avvio della transazione: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Commit transaction.
     *
     * @return bool True on success, false on failure.
     */
    public function commit(): bool {
        try {
            return $this->connection->commit();
        } catch (PDOException $e) {
            error_log("Errore durante il commit della transazione: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Rollback transaction.
     *
     * @return bool True on success, false on failure.
     */
    public function rollback(): bool {
        try {
            return $this->connection->rollBack();
        } catch (PDOException $e) {
            error_log("Errore durante il rollback della transazione: " . $e->getMessage());
            return false;
        }
    }
   
    /**
     * Generic method to execute queries.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters for binding.
     * @return PDOStatement|null The PDOStatement object or null in case of error.
     */
    private function query(string $sql, array $params = []): ?PDOStatement {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Errore nell'esecuzione della query: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Executes an SQL query.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to pass to the query.
     * @return bool True if the execution is successful, false otherwise.
     */
    public function execute(string $sql, array $params = []): bool {
        return $this->query($sql, $params) !== null;
    }

    /**
     * Executes an SQL query and retrieves all resulting rows.
     *
     * @param string $query The SQL query to execute.
     * @param array $params The parameters to pass to the query.
     * @return array An array of all resulting rows.
     */
    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function fetchAllFromTable(string $table, array $conditions = []): array {
        $whereClause = '';
        $params = [];
        if (!empty($conditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
            $params = array_values($conditions);
        }
        $query = "SELECT * FROM $table $whereClause";
        return $this->fetchAll($query, $params);
    }

    /**
     * Executes an SQL query and retrieves a single resulting row.
     *
     * @param string $query The SQL query to execute.
     * @param array $params The parameters to pass to the query.
     * @return mixed The resulting row or false if there are no results.
     */
    public function fetchSingle(string $sql, array $params = []): ?array {
        try {
            $stmt = $this->query($sql, $params);
            $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
            return $result;
        } catch (Exception $e) {
            error_log("Error in fetchSingle: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Inserts a new record into the database and returns the ID of the inserted record.
     *
     * @param string $table The name of the table.
     * @param array $data An associative array of data to insert.
     * @return int|null The ID of the inserted record or null in case of error.
     */
    public function insert(string $table, array $data): ?int {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->query($query, array_values($data));
        return $stmt ? (int) $this->connection->lastInsertId() : null;
    }

    /**
     * Updates a record in the database.
     *
     * @param string $table The name of the table.
     * @param array $data An associative array of data to update.
     * @param string $whereColumn The column to use in the WHERE clause.
     * @param mixed $whereValue The value to use in the WHERE clause.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(string $table, array $data, array $conditions): bool {
        $setClause = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
        $query = "UPDATE $table SET $setClause WHERE $whereClause";
        return $this->execute($query, array_merge(array_values($data), array_values($conditions)));
    }

    /**
     * Prepares a SQL statement.
     *
     * @param string $sql The SQL statement to prepare.
     * @return PDOStatement The prepared statement.
     */
    public function prepare(string $sql): PDOStatement {
        return $this->connection->prepare($sql);
    }

    /**
     * Deletes a record from the database.
     *
     * @param string $table The name of the table.
     * @param string $whereColumn The column to use in the WHERE clause.
     * @param mixed $whereValue The value to use in the WHERE clause.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(string $table, array $conditions): bool {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
        $query = "DELETE FROM $table WHERE $whereClause";
        return $this->execute($query, array_values($conditions));
    }

    /**
     * Loads a record from the database.
     *
     * @param string $table The name of the table.
     * @param string $whereColumn The column to use in the WHERE clause.
     * @param mixed $whereValue The value to use in the WHERE clause.
     * @return array|null An associative array representing the record or null if not found.
     */
    public function load(string $table, string $whereColumn, mixed $whereValue): ?array {
        $query = "SELECT * FROM $table WHERE $whereColumn = :value LIMIT 1";
        $stmt = $this->query($query, ['value' => $whereValue]);
        if ($stmt) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Ensure we return null if no result is found
            return $result ?: null;
        }
        return null;
    }

    /**
     * Loads multiple records from the database based on optional conditions.
     *
     * @param string $table The name of the table.
     * @param array $conditions Optional associative array of conditions for the WHERE clause.
     * @return array An array of all matching records.
     */
    public function loadMultiples(string $table, array $conditions = []): array {
        $whereClause = '';
        $params = [];
        if (!empty($conditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
            $params = $conditions;
        }
        $query = "SELECT * FROM $table $whereClause";
        $stmt = $this->query($query, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    /**
     * Fetches records from the database that match the given conditions.
     *
     * @param string $table The name of the table.
     * @param array $conditions An associative array of conditions for the WHERE clause.
     * @return array An array of matching records.
     * @throws Exception If the conditions array is empty.
     */
    public function fetchWhere(string $table, array $conditions): array {
        if (empty($conditions)) {
            throw new Exception("Le condizioni non possono essere vuote per fetchWhere.");
        }
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
        $query = "SELECT * FROM $table WHERE $whereClause";
        return $this->fetchAll($query, array_values($conditions));
    }

    /**
     * Fetch all records from a table where a column matches one of the values in the array.
     *
     * @param string $table Table name.
     * @param string $column Column name to filter.
     * @param array $values Array of values for the WHERE IN clause.
     * @return array Resulting rows.
     */
    public function fetchWhereIn(string $table, string $column, array $values): array {
        if (empty($values)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($values), '?'));
        $sql = "SELECT * FROM $table WHERE $column IN ($placeholders)";
        return $this->fetchAll($sql, $values);
    }
    
    /**
     * Fetches records from the database where a column's value is between two values.
     *
     * @param string $table The name of the table.
     * @param string $column The column to apply the BETWEEN condition on.
     * @param mixed $minValue The minimum value of the range.
     * @param mixed $maxValue The maximum value of the range.
     * @return array An array of matching records.
     */
    public function fetchBetween(string $table, string $column, mixed $minValue, mixed $maxValue): array {
        $query = "SELECT * FROM $table WHERE $column BETWEEN ? AND ?";
        return $this->fetchAll($query, [$minValue, $maxValue]);
    }
    
    /**
     * Fetches records from the database where a column matches a LIKE pattern.
     *
     * @param string $table The name of the table.
     * @param string $column The column to apply the LIKE condition on.
     * @param string $pattern The pattern to match using LIKE.
     * @return array An array of matching records.
     */
    public function fetchLike(string $table, string $column, string $pattern): array {
        $query = "SELECT * FROM $table WHERE $column LIKE ?";
        return $this->fetchAll($query, [$pattern]);
    }

    /**
     * Checks if a record exists in the database.
     *
     * @param string $table
     * @param array $conditions
     * @return bool True if the record exists, false otherwise.
     */
    public function exists(string $table, array $conditions): bool {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
        $query = "SELECT 1 FROM $table WHERE $whereClause LIMIT 1";
        $stmt = $this->query($query, array_values($conditions));
        return $stmt ? $stmt->fetch() !== false : false;
    }

    /**
     * Get the last inserted ID.
     *
     * @return string|null The ID of the last inserted row or null on failure.
     */
    public function getLastInsertedId(): ?string {
        try {
            $lastId = $this->connection->lastInsertId();
            if (!$lastId) {
                throw new Exception("Nessun ID inserito disponibile.");
            }
            return $lastId;
        } catch (PDOException $e) {
            error_log("Errore durante il recupero dell'ultimo ID inserito: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieves all tables available for reservation on a specified date and time frame,
     * accommodating the given number of guests.
     * Excludes tables already reserved at that date and time frame.
     *
     * @param string $reservationDate Reservation date (YYYY-MM-DD).
     * @param string $timeFrame Time frame of the reservation.
     * @param int $guests Number of guests.
     * @return array Available tables matching the criteria.
     */
    public function getAvailableTables(string $reservationDate, string $timeFrame, int $guests): array {
        // Prima recupero gli idTable prenotati per data e fascia
        $reservedSql = "SELECT r.idTable FROM Reservation r
                        WHERE r.reservationDate = ?
                        AND r.timeFrame = ?
                        AND r.idRoom IS NULL";
        $reservedStmt = $this->query($reservedSql, [$reservationDate, $timeFrame]);
        $reservedTables = $reservedStmt ? $reservedStmt->fetchAll(\PDO::FETCH_COLUMN) : [];

        // Condizioni dinamiche per maxGuests
        $conditions = [
            'maxGuests >=' => $guests,
            'maxGuests <=' => $guests + 1,
        ];

        $whereParts = array_map(fn($key) => "$key ?", array_keys($conditions));
        $params = array_values($conditions);

        // Escludo tavoli prenotati se ce ne sono
        if (count($reservedTables) > 0) {
            $placeholders = implode(',', array_fill(0, count($reservedTables), '?'));
            $whereParts[] = "idTable NOT IN ($placeholders)";
            $params = array_merge($params, $reservedTables);
        }

        $whereClause = implode(' AND ', $whereParts);
        $sql = "SELECT * FROM `tables` WHERE $whereClause";

        return $this->fetchAll($sql, $params);
    }

    /**
     * Retrieves all rooms available for reservation on a specified date and time frame,
     * accommodating the given number of guests.
     * Excludes rooms already reserved at that date and time frame.
     *
     * @param string $reservationDate Reservation date (YYYY-MM-DD).
     * @param string $timeFrame Time frame of the reservation.
     * @param int $guests Number of guests.
     * @return array Available rooms matching the criteria.
     */
    public function getAvailableRooms(string $reservationDate, string $timeFrame, int $guests): array {
        // Recupera gli idRoom già prenotati in quella data e timeFrame (solo prenotazioni di tipo "room")
        $reservedSql = "SELECT r.idRoom FROM Reservation r
                        WHERE r.reservationDate = ?
                        AND r.timeFrame = ?
                        AND r.idTable IS NULL";
        $reservedStmt = $this->query($reservedSql, [$reservationDate, $timeFrame]);
        $reservedRooms = $reservedStmt ? $reservedStmt->fetchAll(\PDO::FETCH_COLUMN) : [];

        // Condizioni su maxGuests con tolleranza di 10 posti
        $conditions = [
            'maxGuests >=' => $guests,
            'maxGuests <=' => $guests + 20,
        ];

        $whereParts = array_map(fn($key) => "$key ?", array_keys($conditions));
        $params = array_values($conditions);

        // Escludi stanze già prenotate
        if (count($reservedRooms) > 0) {
            $placeholders = implode(',', array_fill(0, count($reservedRooms), '?'));
            $whereParts[] = "idRoom NOT IN ($placeholders)";
            $params = array_merge($params, $reservedRooms);
        }

        $whereClause = implode(' AND ', $whereParts);
        $sql = "SELECT * FROM `room` WHERE $whereClause";

        return $this->fetchAll($sql, $params);
    }

    /**
     * Recupera tutte le delivery reservations di un utente, ordinate per data (più recenti prima).
     *
     * @param int $idUser
     * @return array Array associativo di righe (ogni riga è una deliveryreservation)
     */
    public function fetchDeliveryReservationsByUser(int $idUser): array {
        $sql = "
            SELECT 
                idDeliveryReservation,
                idUser,
                userPhone,
                userAddress,
                userNumberAddress,
                wishedTime
            FROM deliveryreservation
            WHERE idUser = ?
            ORDER BY wishedTime DESC
        ";
        return $this->fetchAll($sql, [$idUser]);
    }

    /**
     * Recupera tutti i delivery items associati a una specifica delivery reservation.
     *
     * @param int $idDeliveryReservation
     * @return array Array associativo di righe (ogni riga è un deliveryitem)
     */
    public function fetchDeliveryItemsByReservation(int $idDeliveryReservation): array {
        $sql = "
            SELECT 
                idDeliveryItem,
                idDeliveryReservation,
                idProduct,
                quantity,
                subtotal
            FROM deliveryitem
            WHERE idDeliveryReservation = ?
            ORDER BY idDeliveryItem ASC
        ";
        return $this->fetchAll($sql, [$idDeliveryReservation]);
    }
}