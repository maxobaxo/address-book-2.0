<?php
    class Contact {
        private $last_name;
        private $first_name;
        private $mid_init;
        private $street_num;
        private $city;
        private $state;
        private $zip;
        private $mobile;
        private $email;

        function __construct($last_name, $first_name, $mid_init, $street_num, $city, $state, $zip, $mobile, $email)
        {
            $this->last_name = $last_name;
            $this->first_name = $first_name;
            $this->mid_init = $mid_init;
            $this->street_num = $street_num;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
            $this->mobile = $mobile;
            $this->email = $email;
        }

        function setFirstName($first_name)
        {
            $this->first_name = (string) $first_name;
        }

        function getFirstName()
        {
            return $this->first_name;
        }

        function setLastName($last_name)
        {
            $this->last_name = (string) $last_name;
        }

        function getLastName()
        {
            return $this->last_name;
        }

        function setMidInit($mid_init)
        {
            $this->mid_init = (string) $mid_init;
        }

        function getMidInit()
        {
            return $this->mid_init;
        }

        function setStreet($street_num)
        {
            $this->street_num = (string) $street_num;
        }

        function getStreet()
        {
            return $this->street_num;
        }

        function setCity($city)
        {
            $this->city = (string) $city;
        }

        function getCity()
        {
            return $this->city;
        }

        function setState($state)
        {
            $this->state = (string) $state;
        }

        function getState() {
            return $this->state;
        }

        function setZip($zip) {
            $this->zip = (string) $zip;
        }

        function getZip() {
            return $this->zip;
        }

        function setEmail($email)
        {
            $this->email = (string) $email;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setMobile($mobile)
        {
            $this->mobile = (string) $mobile;
        }

        function getMobile()
        {
            return $this->mobile;
        }

        function save()
        {
            array_push($_SESSION['contacts'], $this);
        }

        static function getAll()
        {
            return $_SESSION['contacts'];
        }

        static function deleteAll()
        {
            $_SESSION['contacts'] = array();
        }
    }
?>
