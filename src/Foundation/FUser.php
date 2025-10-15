<?php
namespace Foundation;

use DateTime;
use Entity\EUser;
use Entity\Role;
use Exception;

/**
 * Class FUser
 * Handles CRUD operations for users in the database.
 */
class FUser {
    /**
     * Name of the table associated with the user entity in the database.
     */
    protected const TABLE_NAME = 'user';

    // Error messages centralized for consistency
    protected const ERR_MISSING_FIELD= 'Missing required field:';
    protected const ERR_USERNAME_TAKEN = 'Username is already taken.';
    protected const ERR_EMAIL_TAKEN = 'Email address is already in use.';
    protected const ERR_MISSING_ID= 'Unable to retrieve the ID of the inserted user';
    protected const ERR_INSERTION_FAILED = 'Error during the insertion of the user.';
    protected const ERR_RETRIVE_USER='Failed to retrive the inserted user.';
    protected const ERR_USER_NOT_FOUND = 'The user does not exist.';
    protected const  ERR_UPDATE_FAILED = 'Username or email already existing. Please try once with a different email and same username, and once with a different username and same email';
    protected const ERR_INVALID_BIRTHDATE = 'Birth Date is invalid.';
    protected const ERR_BIRTHDATE_IN_FUTURE = 'Birth Date can\'t be in the future.';
    protected const ERR_PHONE_INVALID = 'Phone number must contain only digits and be between 8 and 15 characters.';
    protected const ERR_PASSWORD_TOO_SHORT = 'Password must be at least 8 characters long.';
    protected const ERR_PASSWORD_NO_UPPER = 'Password must contain at least one uppercase letter.';
    protected const ERR_PASSWORD_NO_LOWER = 'Password must contain at least one lowercase letter.';
    protected const ERR_PASSWORD_NO_NUMBER = 'Password must contain at least one number.';
    protected const ERR_PASSWORD_NO_SPECIAL = 'Password must contain at least one special character.';


    /**
     * Creates a new user in the database.
     *
     * @param EUser $user The user object to save.
     * @return int The ID of the saved record, or 0 if the save fails.
     * @throws Exception If there is an error during the create operation.
     */
    public function create(EUser $user): int {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($user);
        self::validateUserData($data);
        $user->setPassword($this->hashPassword($user->getPassword()));
        $data = $this->entityToArray($user);
        try {
            //User insertion
            $result = $db->insert(self::TABLE_NAME, $data);
            if ($result === null) {
                throw new Exception(self::ERR_INSERTION_FAILED);
            }
            //Retrive the last inserted ID
            $createdId=$db->getLastInsertedId();
            if ($createdId==null) {
                throw new Exception(self::ERR_MISSING_ID);
            }
            //Retrive the inserted user by number to get the assigned idUser
            $storedUser = $db->load(self::TABLE_NAME, 'idUser', $createdId);
            if ($storedUser === null) {
                throw new Exception(self::ERR_RETRIVE_USER);
            }
            //Assign the retrieved ID to the object
            $user->setIdUser((int)$createdId);
            //Return the id associated with this extra
            return (int)$createdId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Reads a user from the database by their ID.
     *
     * @param int $id The ID of the user to read.
     * @return EUser|null The user object if found, null otherwise.
     */
    public function read(int $idUser): ?EUser {
        $db = FDatabase::getInstance();
        $result = $db->load(static::TABLE_NAME, 'idUser', $idUser);
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**
     * Loads a user from the database by their username.
     *
     * @param string $username The username of the user to read.
     * @return EUser|null The user object if found, null otherwise.
     * @throws Exception
     */
    public function readUserByUsername(string $username): ?EUser {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'username', $username);
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**
     * Loads a user from the database by his email.
     *
     * @param string $username The email of the user to read.
     * @return EUser The user object if found, null otherwise.
     * @throws Exception if no user founded with this email
     */
    public function readUserByEmail(string $email): EUser {
        $db = FDatabase::getInstance();
        $result = $db->load(self::TABLE_NAME, 'email', $email);
        if ($result===null) {
            throw new Exception("No user founded with this email");
        }
        return $result ? $this->arrayToEntity($result) : null;
    }

    /**Updates an existing user in the database.
     *
     * @param EUser $user The user object to update.
     * @param int $id The ID of the user to update.
     * @return bool True if the update was successful, False otherwise.
     */
    public function update(EUser $user): bool {
        $db = FDatabase::getInstance();
        $data = $this->entityToArray($user);
        return $db->update(static::TABLE_NAME, $data, ['idUser' => $user->getIdUser()]);
    }

    /**
     * Updates Profile data an existing user in the database.
     *
     * @param EUser $user The user object to update.
     * @return bool True if the update was successful, False otherwise.
     * @throws Exception If there is an error during the update operation.
     */
    public function updateProfileData(EUser $user): bool {
        $db = FDatabase::getInstance();
        if (!self::exists($user->getIdUser())) {
            throw new Exception(self::ERR_USER_NOT_FOUND);
        }
        //Modifica solo i dati Profilo
        $data = [
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'birthDate' => $user->getBirthDate(),
            'phone' => $user->getPhone()
        ];
        //Controllo se i campi inseriti non sono vuoti
        if(empty($data['name'])) {
            throw new Exception("Name field can't be empty");
        }
        if(empty($data['surname'])) {
            throw new Exception("Username field can't be empty");
        }
        if(empty($data['birthDate'])) {
            throw new Exception("Birth date can't be empty");
        }
        //Verifico che la data inserita non sia nel fututo
        $today=new DateTime();
        $birthDate=new DateTime($data['birthDate']);
        if($birthDate>$today) {
            throw new Exception("Birth date can't be in future");
        }
        if(empty($data['phone'])) {
            throw new Exception("Phone field can't be empty");
        }
        if (!ctype_digit($data['phone'])) {
            throw new Exception("Phone field must contain only numbers");
        }
        if (!$db->update(self::TABLE_NAME, $data, ['idUser' => $user->getIdUser()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Update Username, Email and Password an existing user in db
     */
    public function updateProfileMetadata(EUser $user): bool {
        $db = FDatabase::getInstance();
        if(!self::exists($user->getIdUser())) {
            throw new Exception(self::ERR_USER_NOT_FOUND);
        }
        //Modifica dei metadati
        $data=[
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
        // Controllo se esistono duplicati per email e username
        if (self::isUsernameDuplicated($data['username'], $user->getIdUser())) {
            throw new Exception('Username already in use by another user.');
        }
        if (self::isEmailDuplicated($data['email'], $user->getIdUser())) {
            throw new Exception('Email already in use by another user.');
        }
        //Faccio il controllo sui dati, in particolare quelli della password
        if (empty($data['username'])) {
            throw new Exception("Username is required");
        }
        if (empty($data['email'])) {
            throw new Exception("Email is required");
        }
        //Controlli sulla password
        if (empty($data['password'])) {
            throw new Exception("Password is required.");
        }
        $password = $data['password'];
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long.");
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new Exception("Password must contain at least one uppercase letter.");
        }
        if (!preg_match('/[a-z]/', $password)) {
            throw new Exception("Password must contain at least one lowercase letter.");
        }
        if (!preg_match('/\d/', $password)) {
            throw new Exception("Password must contain at least one number.");
        }
        if (!preg_match('/[^a-zA-Z\d]/', $password)) {
            throw new Exception("Password must contain at least one special character.");
        }
        //Se i controlli vanno a buon fine, aggiorno i vecchi dati e faccio l'hashing della password
        $hashedPassword=$this->hashPassword($user->getPassword());
        $data['password']=$hashedPassword;
        if (!$db->update(self::TABLE_NAME, $data, ['idUser' => $user->getIdUser()])) {
            throw new Exception(self::ERR_UPDATE_FAILED);
        }
        return true;
    }

    /**
     * Deletes a user from the database by their ID.
     *
     * @param int $idUser The ID of the user to delete.
     * @return bool True if the deletion was successful, False otherwise.
     */
    public function delete(int $idUser): bool {
        $db = FDatabase::getInstance();
        return $db->delete(static::TABLE_NAME, ['idUser' => $idUser]);
    }

    /**
     * Reads all users from the database.
     *
     * @return EUser[] An array of EUser objects.
     */
    public function readAll(): array {
        $db = FDatabase::getInstance();
        $results = $db->fetchAllFromTable(static::TABLE_NAME);
        return array_map([$this, 'arrayToEntity'], $results);
    }

    /**
     * Returns a list of blocked users from the database.
     *
     * @return EUser[] An array of EUser objects representing the blocked users.
     * @throws Exception If an error occurs during the loading process.
     */
    public function readBlockedUsers(): array {
        $db = FDatabase::getInstance();
        $results = $db->fetchWhere(static::TABLE_NAME, ['ban' => 1]);
        return array_map([$this, 'arrayToEntity'], $results);
    }

    /**
     * Bans a user in the database, only if the requesting user is an admin
     * and the target user has the role of a normal user.
     *
     * @param EUser $admin The user attempting to perform the ban (must be an admin).
     * @param EUser $target The user to be banned (must be a regular user).
     * @return bool True if the operation was successful, false otherwise.
     */
    public function banUser(EUser $admin, EUser $target): bool {
        if ($admin->isAdmin() && $target->isUser()) {
            $db = FDatabase::getInstance();
            return $db->update(FUser::TABLE_NAME, ['ban' => 1], ['idUser' => $target->getIdUser()]);
        }
        return false;
    }

    /**
     * Unbans a user in the database.
     *
     * @param EUser $admin The admin performing the action.
     * @param EUser $target The user to be unbanned.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function unbanUser(EUser $admin, EUser $target): bool {
        if ($admin->isAdmin() && $target->isUser()) {
            $db = FDatabase::getInstance();
            return $db->update(FUser::TABLE_NAME, ['ban' => 0], ['idUser' => $target->getIdUser()]);
        }
        return false;
    }

    /**
     * Checks if a user exists in the database by their ID.
     *
     * @param string $idUser The ID of the user to check.
     * @return bool True if the user exists, false otherwise.
     */
    public static function exists(int $idUser): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['idUser' => $idUser]);
    }

    /**
     * Checks if a user exists in the database by username.
     *
     * @param string $username The username to check.
     * @return bool True if it exists, False otherwise.
     */
    public static function existsByUsername(string $username): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['username' => $username]);
    }

    /**
     * Checks if a user exists in the database by email.
     *
     * @param string $email The email to check.
     * @return bool True if it exists, False otherwise.
     */
    public static function existsByEmail(string $email): bool {
        $db = FDatabase::getInstance();
        return $db->exists(self::TABLE_NAME, ['email' => $email]);
    }

    /**
     * Hashes the password using the bcrypt algorithm.
     *
     * @param string $password The plain-text password.
     * @return string The hashed password.
     */
    public function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Validates all user parametres
     *
     *
     * @param array $data Associative array containing user input fields.
     * @throws Exception if any validation fails.
     */
    function validateUserData(array $data): void {
        //Validazione Username
        if (empty($data['username'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' username');
        }
        if (self::existsByUsername($data['username'])) {
            throw new Exception(self::ERR_USERNAME_TAKEN);
        }
        //Validazione Nome
        if (empty($data['name'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' name');
        }
        //Validazione Cognome
        if (empty($data['name'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' name');
        }
        //Validazione Data di nascita
        if (empty($data['birthDate'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' birthDate');
        }
        $birthdate = strtotime($data['birthDate']);
        if ($birthdate === false || $birthdate === 0) {
            throw new Exception(self::ERR_INVALID_BIRTHDATE);
        }
        $now = time();
        if ($birthdate > $now) {
            throw new Exception(self::ERR_BIRTHDATE_IN_FUTURE);
        }
        //Validazione email 
        if (empty($data['email'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' email');
        }
        if (self::existsByEmail($data['email'])) {
            throw new Exception(self::ERR_EMAIL_TAKEN);
        }
        //Validazione numero di telefono
        if (empty($data['phone'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' phone');
        }
        $phone = $data['phone'];
        if (!preg_match('/^\+?\d{8,15}$/', $phone)) {
            throw new Exception(self::ERR_PHONE_INVALID);
        }
        //Validazione della Password
        if (empty($data['password'])) {
            throw new Exception(self::ERR_MISSING_FIELD . ' password');
        }
        $password = $data['password'];
        if (strlen($password) < 8) {
            throw new Exception(self::ERR_PASSWORD_TOO_SHORT);
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new Exception(self::ERR_PASSWORD_NO_UPPER);
        }
        if (!preg_match('/[a-z]/', $password)) {
            throw new Exception(self::ERR_PASSWORD_NO_LOWER);
        }
        if (!preg_match('/\d/', $password)) {
            throw new Exception(self::ERR_PASSWORD_NO_NUMBER);
        }
        if (!preg_match('/[^a-zA-Z\d]/', $password)) {
            throw new Exception(self::ERR_PASSWORD_NO_SPECIAL);
        }
    }

    /**
     * Checks if the provided email is duplicated in the database,
     * excluding the user with the specified ID.
     *
     * @param string $email The email to check.
     * @param int $excludedIdUser The user ID to exclude from the check.
     * @return bool True if the email is duplicated, false otherwise.
     */
    function isEmailDuplicated(string $email, int $excludedIdUser): bool {
        $db = FDatabase::getInstance();
        $users = $db->fetchAll('users', [
            'email' => $email,
            'idUser[!]' => $excludedIdUser
        ]);
        return !empty($users);
    }

    /**
     * Checks if the provided username is duplicated in the database,
     * excluding the user with the specified ID.
     *
     * @param string $username The username to check.
     * @param int $excludedIdUser The user ID to exclude from the check.
     * @return bool True if the username is duplicated, false otherwise.
     */
    function isUsernameDuplicated(string $username, int $excludedIdUser): bool {
        $db = FDatabase::getInstance();
        $users = $db->fetchAll('users', [
            'username' => $username,
            'idUser[!]' => $excludedIdUser
        ]);
        return !empty($users);
    }

    /**
     * Creates an EUser entity from the provided data.
     *
     * @param array $data The data used to create the EUser object.
     * @return EUser The created user object.
     * @throws Exception If required fields are missing.
     */
    private function arrayToEntity(array $data):EUser {
        $requiredFields = ['idUser', 'username', 'email', 'password', 'name', 'surname', 'birthDate', 'phone', 'role'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new Exception(self::ERR_MISSING_FIELD . $field);
            }
        }
        return new EUser(
            $data['idUser'],
            $data['idReview'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['name'],
            $data['surname'],
            new DateTime($data['birthDate']),
            $data['phone'],
            isset($data['role']) ? Role::Tryfrom($data['role']) : null,
            $data['ban']
        );
    }

    /**
     * Converts an EUser object into an associative array for the database.
     *
     * @param EUser $user The user object to convert.
     * @return array The user data as an array.
     */
    private function entityToArray(EUser $user): array {
        return [
            'idUser' => $user->getIdUser(),
            'idReview' => $user->getIdReview(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'ban' => $user->getBan() ? 1 : 0,
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'birthDate' => $user->getBirthDate(),
            'phone' => $user->getPhone(),
            'role' => $user->getRole(),
        ];
    }
}