<?php

namespace App\Entity;

interface CategoryInterface
{
    const ROOT_ID = 1;

    public function getId();

    public function getChildren();

    public function getParent(): ?self;

    public function setParent(?CategoryInterface $category);

    public function getName(): ?string;

    public function setName(string $name);
}
