<?php
    class Contact {

        private $first_name;
        private $last_name;
        private $street_num;
        private $city;
        private $state;
        private $zip;
        private $mobile;
        private $email;

        function __construct($first_name, $last_name, $street_num, $city, $state, $zip, $mobile, $email) {

            $this->$first_name = $first_name;
            $this->$last_name = $last_name;
            $this->$street_num = $street_num;
            $this->$city = $city;
            $this->$state = $state;
            $this->$zip = $zip;
            $this->$mobile = $mobile;
            $this->$email = $email;
        }

        function setFirstName($first_name) {
            $this->$first_name = $first_name;
        }

        function getFirstName() {
            return $this->$first_name;
        }

        function setLastName($last_name) {
            $this->$last_name = $last_name;
        }

        function getLastName() {
            return $this->$last_name;
        }

        function setStreet($street_num) {
            $this->$street_num = $street_num;
        }

        function getStreet() {
            return $this->$street_num;
        }

        function setCity($city) {
            $this->$city = $city;
        }

        function getCity() {
            return $this->$city;
        }

        function setState($state) {
            $this->$state = $state;
        }

        function getState() {
            return $this->$state;
        }

        function setZip($zip) {
            $this->$zip = $zip;
        }

        function getZip() {
            return $this->$zip;
        }

        function setEmail($email) {
            $this->$email = $email;
        }

        function getEmail() {
            return $this->$email;
        }

        function setMobile($mobile) {
            $this->$mobile = $mobile;
        }

        function getMobile() {
            return $this->$mobile;
        }

        function save() {
            array_push($_SESSION['contacts'], $this);
        }

        static function getAll() {
            return $_SESSION['contacts'];
        }

        static function deleteAll() {
            $_SESSION['contacts'] = array();
        }
    }
?>
