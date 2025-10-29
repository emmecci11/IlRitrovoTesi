<?php

namespace Entity;

use JsonSerializable;
use DateTime;

/**
 * Class EDeliveryReservation
 */
class EDeliveryReservation implements JsonSerializable {
    /**
     * @var int ID della prenotazione di consegna
     */
    private int $idDeliveryReservation;

    /**
     * @var int ID dell utente
     */
    protected int $idUser;

    /**
     * @var string Numero di telefono dell utente
     */
    protected string $userPhone;

    /**
     * @var string Indirizzo dell utente
     */
    protected string $userAddress;

    /**
     * @var int N. indirizzo dell utente (in base a un sistema di codice postale)
     */
    protected int $userNumberAddress;

    /**
     * @var DateTime Ora desiderata per la consegna
     */
    private DateTime $wishedTime;

    /**
     * Costruttore.
     *
     * @param int   $idDeliveryreservation  ID della prenotazione di consegna
     * @param int   $idUser          ID dell utente
     * @param string $userPhone      Numero di telefono dell utente
     * @param string $userAddress    Indirizzo dell utente
     * @param int   $userNumberAddress  N. indirizzo dell utente (in base a un sistema di codice postale)
     * @param DateTime $wishedTime     Ora desiderata per la consegna
     */
    public function __construct(int $idDeliveryReservation, int $idUser, string $userPhone, string $userAddress, int $userNumberAddress, DateTime $wishedTime) {
        $this->setIdDeliveryReservation($idDeliveryReservation);
        $this->setIdUser($idUser);
        $this->setUserPhone($userPhone);
        $this->setUserAddress($userAddress);
        $this->setUserNumberAddress($userNumberAddress);
        $this->setWishedTime($wishedTime);
    }

    /**
     * Ottieni l'ID della prenotazione di consegna.
     *
     * @return int ID della prenotazione di consegna
     */
    public function getIdDeliveryReservation(): int {
        return $this->idDeliveryReservation;
    }

    /**
     * Imposta l'ID della prenotazione di consegna.
     *
     * @param int   $idDeliveryreservation  ID della prenotazione di consegna
     */
    public function setIdDeliveryReservation(int $idDeliveryReservation): void {
        $this->idDeliveryReservation = $idDeliveryReservation;
    }

    /**
     * Ottieni l'ID dell utente.
     *
     * @return int ID dell utente
     */
    public function getIdUser(): int {
        return $this->idUser;
    }

    /**
     * Imposta l'ID dell utente.
     *
     * @param int   $idUser  ID dell utente
     */
    public function setIdUser(int $idUser): void {
        $this->idUser = $idUser;
    }

    /**
     * Ottieni il numero di telefono dell utente.
     *
     * @return string Numero di telefono dell utente
     */
    public function getUserPhone(): string {
        return $this->userPhone;
    }

    /**
     * Imposta il numero di telefono dell utente.
     *
     * @param string $userPhone  Numero di telefono dell utente
     */
    public function setUserPhone(string $userPhone): void {
        $this->userPhone = $userPhone;
    }

    /**
     * Ottieni l'indirizzo dell utente.
     *
     * @return string Indirizzo dell utente
     */
    public function getUserAddress(): string {
        return $this->userAddress;
    }

    /**
     * Imposta l'indirizzo dell utente.
     *
     * @param string $userAddress  Indirizzo dell utente
     */
    public function setUserAddress(string $userAddress): void {
        $this->userAddress = $userAddress;
    }

    /**
     * Ottieni il N. indirizzo dell utente (in base a un sistema di codice postale).
     *
     * @return int N. indirizzo dell utente
     */
    public function getUserNumberAddress(): int {
        return $this->userNumberAddress;
    }

    /**
     * Imposta il N. indirizzo dell utente (in base a un sistema di codice postale).
     *
     * @param int   $userNumberAddress  N. indirizzo dell utente
     */
    public function setUserNumberAddress(int $userNumberAddress): void {
        $this->userNumberAddress = $userNumberAddress;
    }

    /**
     * Ottieni l'ora desiderata per la consegna.
     *
     * @return DateTime Ora desiderata per la consegna
     */
    public function getWishedTime(): DateTime {
        return $this->wishedTime;
    }

    /**
     * Imposta l'ora desiderata per la consegna.
     *
     * @param DateTime $wishedTime  Ora desiderata per la consegna
     */
    public function setWishedTime(DateTime $wishedTime): void {
        $this->wishedTime = $wishedTime;
    }

    /**
     * Ottieni le proprietà dell'oggetto come array associativo.
     *
     * @return array Associative array di proprietà dell'oggetto.
     */
    public function jsonSerialize(): array {
        return [
            'idDeliveryReservation' => $this->idDeliveryReservation,
            'idUser'          => $this->idUser,
            'userPhone'      => $this->userPhone,
            'userAddress'    => $this->userAddress,
            'userNumberAddress' => $this->userNumberAddress,
            'wishedTime'     => $this->wishedTime,
        ];
    }
}