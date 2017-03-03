s<?php
    class Store {
        private $name;
        private $pricing;
        private $location;
        private $id;

        function __construct($name, $pricing, $location, $id = null) {
            $this->name = $name;
            $this->pricing = $pricing;
            $this->location = $location;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getPricing()
        {
            return $this->pricing;
        }

        function setPricing($pricing)
        {
            $this->pricing = $pricing;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($location)
        {
            $this->location = $location;
        }

    }


?>
