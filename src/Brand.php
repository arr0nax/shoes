s<?php
    class Brand {
        private $name;
        private $pricing;
        private $id;

        function __construct($name, $pricing, $id = null) {
            $this->name = $name;
            $this->pricing = $pricing;
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

    }


?>
