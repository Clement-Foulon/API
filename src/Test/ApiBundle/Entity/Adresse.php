<?php

namespace Test\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Test\ApiBundle\Entity\Contact;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="Test\ApiBundle\Repository\AdresseRepository")
 */
class Adresse {

    /**
     *  @ORM\ManyToOne(targetEntity="Test\ApiBundle\Entity\Contact", inversedBy="adresses")
     *  @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $contact;

     public function setContact(Contact $c) {
        $this->contact = $c;
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
     * @ORM\Column(name="Rue", type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="CodePostal", type="string", length=5)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255)
     */
    private $ville;

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
     * Set rue
     *
     * @param string $rue
     *
     * @return Adresse
     */
    public function setRue($rue) {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue() {
        return $this->rue;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Adresse
     */
    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set creeLe
     *
     * @param \DateTime $creeLe
     *
     * @return Adresse
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
     * @return Adresse
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
