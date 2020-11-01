<?php
namespace App\Document;

use App\Document\Ingredient;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class Pizza
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

     /**
     * @MongoDB\ReferenceMany(targetDocument=Ingredient::class)
     */
    private $ingredients = [];


		public function getId(): ?string {
			 return $this->id;
	 	}
	 	public function getName(): ?string {
        return $this->name;
    }
		public function setName(string $name): void {
        $this->name = $name;
    }
    public function setIngredients(array $ingredients): void {
      $this->ingredients[] = $ingredients;
  }

		public function getPrice(): ?string {
        return $this->price;
    }
		public function setPrice(float $price): void {
        $this->price = $price;
    }
}
