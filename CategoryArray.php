<?php

namespace App\Entity;

use App\Utils\CategoryHelper;
use App\Entity\ECommerceCategory as Category;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CategoryArray.
 *
 * @property Category $activeEntity
 */
class CategoryArray implements CategoryInterface
{
    private $activeEntity;
    /** @var Category[] */
    private static $categories;
    private static $em;

    public function __construct($activeEntityId, ?ObjectManager $em = null)
    {
        if ($em) {
            self::$em = $em;
            $categories = $em->getRepository(Category::class)->findAll();
            $this->setCategories($categories);
        }
        $this->activeEntity = self::$categories[$activeEntityId];
    }

    public function getChildren()
    {
        $children = [];
        foreach (self::$categories as $category) {
            if ($category->getParentId() === $this->activeEntity->getId()) {
                $children[] = new self($category->getId());
            }
        }

        return $children;
    }

    public function getParent(): ?CategoryInterface
    {
        $parentId = $this->activeEntity->getParentId();

        return $parentId ? new self($parentId) : null;
    }

    public function getName(): string
    {
        return $this->activeEntity->getName();
    }

    public function getId()
    {
        return $this->activeEntity->getId();
    }

    /**
     * @param Category[] $categories
     */
    private function setCategories(array $categories): void
    {
        foreach ($categories as $category) {
            self::$categories[$category->getId()] = $category;
        }
    }

    /**
     * @throws \Exception
     */
    public function setName(string $name)
    {
        throw new \Exception('Not support set operation');
    }

    /**
     * @throws \Exception
     */
    public function setParent(?CategoryInterface $category)
    {
        throw new \Exception('Not support set operation');
    }

    public function __call(string $name, array $arg)
    {
        $method = 'get'.ucfirst($name);

        return $this->activeEntity->$method();
    }

    public function count(): int
    {
        return self::$em->getRepository(Product::class)->count([
            'eCommerceCategory' => (new CategoryHelper)->getNested($this->activeEntity),
        ]);
    }
}
