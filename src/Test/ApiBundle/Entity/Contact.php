<?php

namespace Test\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="Test\ApiBundle\Repository\ContactRepository")
 */
class Contact {

    /**
     * @ORM\OneToMany(targetEntity="Test\ApiBundle\Entity\Adresse", mappedBy="contact", cascade={"persist", "remove"})
     */
    private $Adresses;

    public function getAdresses() {
        return $this->Adresses;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateNaissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreeLe", type="datetime", nullable=true)
     */
    private $creeLe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MisAjour", type="datetime", nullable=true)
     */
    private $misAjour;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Contact
     */
    public function setCivilite($civilite) {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite() {
        return $this->civilite;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Contact
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Contact
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Contact
     */
    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    /**
     * Set creeLe
     *
     * @param \DateTime $creeLe
     *
     * @return Contact
     */
    public function setCreeLe($creeLe) {
        $this->creeLe = $creeLe;

        return $this;
    }

    /**
     * Get creeLe
     *
     * @return \DateTime
     */
    public function getCreeLe() {
        return $this->creeLe;
    }

    /**
     * Set misAjour
     *
     * @param \DateTime $misAjour
     *
     * @return Contact
     */
    public function setMisAjour($misAjour) {
        $this->misAjour = $misAjour;

        return $this;
    }

    /**
     * Get misAjour
     *
     * @return \DateTime
     */
    public function getMisAjour() {
        return $this->misAjour;
    }

}
