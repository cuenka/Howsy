<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Name of tables always with a prefix so we aself reserved words
 * @ORM\Table(name="howsy_property", indexes={@ORM\Index(name="property_idx", columns={"property_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="property_id")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="property_date_created")
     * @Assert\NotNull
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", name="property_date_modified")
     * @Assert\NotNull
     */
    private $dateModified;

    /**
     * @ORM\Column(type="string", length=255, name="property_address_line_1")
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Property name must be at least {{ limit }} characters long",
     *      maxMessage = "Property name cannot be longer than {{ limit }} characters"
     * )
     */
    private $addressLine1;

    /**
     * @ORM\Column(type="string", length=255, name="property_address_line_2", nullable=true)
     */
    private $addressLine2;

    /**
     * @ORM\Column(type="string", length=255, name="property_city", nullable=true)
     * @Assert\Type(type="alnum")
     * @Assert\Type(type="space")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10, name="property_post_code", nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Property name must be at least {{ limit }} characters long",
     *      maxMessage = "Property name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(type="alnum")
     * @Assert\Type(type="space")
     */
    private $postCode;

    /**
     * @var float $latitude
     * @ORM\Column(type="float", name="property_latitude", nullable=true)
     */
    private $latitude;

    /**
     * @var float $longitude
     * @ORM\Column(type="float", name="property_longitude", nullable=true)
     */
    private $longitude;

    /**
     * Property constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
        $this->dateModified = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return Property
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated() : \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     * @return Property
     */
    public function setDateCreated(\DateTime $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateModified() : \DateTime
    {
        return $this->dateModified;
    }

    /**
     * @param \DateTime $dateModified
     * @return Property
     */
    public function setDateModified(\DateTime $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @return string
     *
     */
    public function getAddressLine1() : string
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     * @return Property
     */
    public function setAddressLine1(string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;

    }

    /**
     * @return string
     */
    public function getAddressLine2() : string
    {
        return $this->addressLine2;
    }

    /**
     * @param mixed $addressLine2
     * @return Property
     */
    public function setAddressLine2($addressLine2): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->city;
    }


    /**
     * @param mixed $city
     * @return Property
     */
    public function setCity($city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     * @return Property
     */
    public function setPostCode($postCode): self
    {
        $this->postCode = $postCode;
        
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return Property
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return Property
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }


}
