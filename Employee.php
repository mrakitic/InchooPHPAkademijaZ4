<?php

include_once "idsingleton.php";


class Employee
{
    private $id;
    private $name;
    private $lastname;
    private $birthDate;
    private $monthlyIncome;
    private $gender;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getMonthlyIncome()
    {
        return $this->monthlyIncome;
    }

    /**
     * @param mixed $monthlyIncome
     */
    public function setMonthlyIncome($monthlyIncome)
    {
        $this->monthlyIncome = $monthlyIncome;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getAge()
    {
        $date = $this->birthDate;
        $now = new DateTime('NOW');
        $interval = $date->diff($now)->format('%a');
        return intval($interval);
    }

    function __construct($id,$name,$lastname, $birthDate, $monthlyIncome, $gender) {
    $this->id=$id;
    $this->name=$name;
    $this->lastname=$lastname;
    $this->birthDate=$birthDate;
    $this->monthlyIncome=$monthlyIncome;
    $this->gender=$gender;
    }

}