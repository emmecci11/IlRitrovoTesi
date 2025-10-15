<?php

namespace Entity;
use DateTime;
use JsonSerializable;

enum Role: string {
    case UTENTE = 'user';
    case AMMINISTRATORE = 'admin';
}

/**
 * Class EUser
 * Represents the user with their main properties.
 */
class EUser implements JsonSerializable {
    /** 
     * IDENTIFIERS
     * @var ?int The univocal identifier for a single user, managed by the database. 
     */
    private ?int $idUser;

    /** 
     * @var int The univocal identifier for a single Review, managed by the database.
     */
    private ?int $idReview;

    /**
     * METADATA
     * @var string Username of the user. 
     */
    protected string $username;

    /** 
     * @var string Email of the user. 
     */
    protected string $email;

    /** 
     * @var string Password of the user. 
     */
    protected string $password;

    /** 
     * @var bool Tracks whether the password has been changed. Private access. 
     */
    public bool $passwordChanged = false;

    /** 
     * @var bool Indicates if the user is banned. 
     */
    private bool $ban;

    /** 
     * @var array User's reservations. 
     */
    private array $reservations;

    /** 
     * @var array User's credit cards. 
     */
    private array $creditCards;

    /**
     * PERSONAL_INFORMARTION 
     * @var string First name of the user. 
     */
    public string $name;

    /** 
     * @var string Last name of the user. 
     */
    public string $surname;

    /** 
     * @var DateTime Date of birth of the user. 
     */
    public DateTime $birthDate;

    /** 
     * @var string Phone number of the user. 
     */
    public string $phone;

    /**
     * @var Role describes the role of the User
     */
    private Role $role;

    /**
     * Constructor for the EUser class.
     *
     * @param int $idUser User ID, can be null.
     * @param int $idReview Review ID, can be an optional.
     * @param string $username Username
     * @param string $email User's email
     * @param string $password User's password
     * @param bool $ban Indicates if the user is banned (default: false).
     * @param string $name First name of the user
     * @param string $surname Last name of the user
     * @param DateTime $birthDate User's date of birth
     * @param string $phone User's phone number
     * @var Role $role descrive the role of the person
     */
    public function __construct(
        ?int $idUser,
        ?int $idReview,
        string $username,
        string $email,
        string $password,
        string $name,
        string $surname,
        DateTime $birthDate,
        string $phone,
        Role $role,
        bool $ban = false
    ) {
        $this->idUser = $idUser;
        $this->idReview = $idReview;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->ban = $ban;
        $this->reservations = [];
        $this->creditCards = [];
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
        $this->role = $role;
    }

    /**
     * Gets the user ID.
     *
     * @return ?int User ID or null if not assigned.
     */
    public function getIdUser(): ?int{
        return $this->idUser;
    }

    /**
     * Sets the user ID.
     *
     * @param ?int $idUser User ID to set, can be null.
     */
    public function setIdUser(?int $idUser): void {
        $this->idUser = $idUser;
    }

    /**
     * Gets the user's review.
     *
     * @return int User's review.
     */
    public function getIdReview(): ?int {
        return $this->idReview;
    }

    /**
     * Sets the unique identifier for the Review.
     *
     * @param int|null $idReview The ID to set.
     */
    public function setIdReview(?int $idReview): void {
        $this->idReview = $idReview;
    }

    /**
     * Returns true if the user has already written the review
     *
     * @return bool
     */
    public function hasReview(): bool {
        return $this->isUser() && $this->idReview !== null;
    }

    /**
     * Gets the username.
     *
     * @return string The user's username.
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Sets the username.
     *
     * @param string $username The username to set.
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * Gets the email.
     *
     * @return string The user's email.
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Sets the email with validation.
     *
     * @param string $email The email to set.
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * Gets the password.
     *
     * @return string The user's password.
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Sets the password and marks it as changed.
     *
     * @param string $password The password to set.
     */
    public function setPassword(string $password): void {
        $this->password = $password;
        $this->passwordChanged = true;
    }

    /**
     * Checks if the password has been changed.
     *
     * @return bool True if the password has been changed, false otherwise.
     */
    public function isPasswordChanged(): bool {
        return $this->passwordChanged;
    }

    /**
     * Checks if the user is banned.
     *
     * @return int (0 if false not banned, 1 if true banned).
     */
    public function getBan(): int {
        return $this->ban ? 1:0; 
    }

    /**
     * Sets the ban status of the user.
     *
     * @param bool $ban True to ban the user, false to unban.
     */
    public function setBan(bool $ban): void {
        $this->ban = $ban;
    }

    /**
     * Gets the user's reservations.
     *
     * @return array User's reservations.
     */
    public function getReservations(): array {
        return $this->reservations;
    }

    /**
     * Adds a reservation to the user's reservations.
     *
     * @param EReservation $reservation The reservation to add.
     */
    public function addReservation(EReservation $reservation): void {
        $this->reservations[] = $reservation;
    }

    /**
     * Removes a reservation from the user's reservations.
     *
     * @param EReservation $reservation The reservation to remove.
     */
    public function removeReservation(EReservation $reservation): void {
        $this->reservations = array_filter($this->reservations, fn($r) => $r !== $reservation);
    }

    /**
     * Checks if the user is a user and if it has at least one reservation
     * 
     * @return bool
     */
    public function hasReservation(): bool {
        return $this->isUser() && !empty($this->reservations);
    }

    /**
     * Gets the user's credit cards.
     *
     * @return array User's credit cards.
     */
    public function getCreditCards(): array {
        return $this->creditCards;
    }

    /**
     * Adds a credit card to the user's credit cards.
     *
     * @param ECreditCard $creditCard The credit card to add.
     */
    public function addCreditCard(ECreditCard $creditCard): void {
        $this->creditCards[] = $creditCard;
    }

    /**
     * Removes a credit card from the user's credit cards.
     *
     * @param ECreditCard $creditCard The credit card to remove.
     */
    public function removeCreditCard(ECreditCard $creditCard): void {
        $this->creditCards = array_filter($this->creditCards, fn($cc) => $cc !== $creditCard);
    }

    /**
     * Check if this is a user and if it has at least one credit card.
     * 
     * @return bool
     */
    public function hasCreditCard(): bool {
        return $this->isUser() && !empty($this->creditCards);
    }

    /**
     * Gets the first name of the user.
     *
     * @return string The user's first name.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Sets the first name of the user.
     *
     * @param string $name The first name to set.
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Gets the surname of the user.
     *
     * @return string The user's surname.
     */
    public function getSurname(): string {
        return $this->surname;
    }

    /**
     * Sets the surname of the user.
     *
     * @param string $surname the surname to set.
     */
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    /**
     * Gets the date of birth of the user.
     *
     * @return string The user's date of birth.
     */
    public function getBirthDate(): string {
        return $this->birthDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets the date of birth of the user.
     *
     * @param DateTime $birthDate The date of birth to set.
     */
    public function setBirthDate(DateTime $birthDate): void {
        $this->birthDate = $birthDate;
    }

    /**
     * Gets the phone number of the person.
     *
     * @return string The person's phone number.
     */
    public function getPhone(): string {
        return $this->phone;
    }

    /**
     * Sets the phone number of the person.
     *
     * @param string $phone The phone number to set.
     */
    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    /**
     * Gets the person's role.
     *
     * @return Role person's role.
     */
    public function getRole(): string {
        return $this->role->value;
    }

    /**
     * Sets the peroson's role.
     *
     * @param string $role person's role.
     */
    public function setRole(string $role): void {
        $enum=Role::tryFrom($role);
        $this->role=$enum;
    }

    /**
     * Returns true if the user's role is USER.
     *
     * @return bool
     */
    public function isUser(): bool {
        return $this->role === Role::UTENTE;
    }

    /**
     * Returns true if the user's role is ADMIN.
     *
     * @return bool
     */
    public function isAdmin(): bool {
        return $this->role === Role::AMMINISTRATORE;
    }

    /**
     * Implementation of the jsonSerialize method.
     *
     * @return array Associative array of the object's properties.
     */
    public function jsonSerialize(): array {
        return [
            'idUser' => $this->idUser,
            'idReview' => $this->idReview,
            'username' => $this->getUsername(),
            'email' => $this->getEmail(), // Include email if necessary
            // Note: We avoid serializing the password for security reasons.
            'ban' => $this->ban,
            'reservations' => $this->reservations,
            'creditCards' => $this->creditCards,
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'birthDate' => $this->getBirthDate(),
            'phone' => $this->getPhone(),
            'role' => $this->getRole()
        ];
    }
}