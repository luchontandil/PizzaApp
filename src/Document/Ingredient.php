<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class Ingredient
{
		/**
		 * @MongoDB\Id
		 */
    private $id;

		/**
     * @MongoDB\Field(type="string")
     */
    protected $name;

		/**
     * @MongoDB\Field(type="float")
     */
    protected $price;


		public function getId(): ?string {
			 return $this->id;
	 	}
	 	public function getName(): ?string {
        return $this->name;
    }
		public function setName(string $name): void {
        $this->name = $name;
    }

		public function getPrice(): ?string {
        return $this->price;
    }
		public function setPrice(float $price): void {
        $this->price = $price;
    }
}
