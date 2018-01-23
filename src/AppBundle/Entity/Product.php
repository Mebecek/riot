<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8. 7. 2017
 * Time: 10:50
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=5,
     *     minMessage="Title is too short!",
     *     max=50,
     *     maxMessage="Title is too long!"
     * )
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=5,
     *     minMessage="Perex is too short!",
     *     max=100,
     *     maxMessage="Perex is too long!"
     * )
     */
    private $perex;

    /**
     * @ORM\Column(type="text", length=500, nullable=true)
     * @Assert\NotBlank()
     */
    private $text;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductPicture", mappedBy="product", cascade={"all"}, orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->date = new \DateTime("now");
    }

    /**
     * @return ArrayCollection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param ArrayCollection $pictures
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
    }

    public function getimageFile()
    {
        return null;
    }

    public function setimageFile(array $files=array())
    {
        if (!$files) return [];
        foreach ($files as $file) {
            if (!$file) return [];
            $this->imageFile($file);
        }
        return [];
    }

    public function imageFile(UploadedFile $file=null)
    {
        if (!$file) {
            return;
        }
        $picture = new ProductPicture();
        $picture->setImageFile($file);
        $this->addPicture($picture);
    }

    public function addPicture(ProductPicture $picture)
    {
        $picture->setProduct($this);
        $this->pictures->add($picture);
    }

    public function removePicture(ProductPicture $picture)
    {
        $picture->setProduct(null);
        $this->pictures->removeElement($picture);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getPerex()
    {
        return $this->perex;
    }

    /**
     * @param mixed $perex
     */
    public function setPerex($perex)
    {
        $this->perex = $perex;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}