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
        };
    }
?>
