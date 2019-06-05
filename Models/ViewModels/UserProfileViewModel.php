<?php


namespace Models\ViewModels;


class UserProfileViewModel
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * UserProfileViewModel constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}