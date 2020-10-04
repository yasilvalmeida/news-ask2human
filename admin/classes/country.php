<?php
    class Country implements JsonSerializable
    {
        private $id;
        private $code;
        private $name;
        private $state;
        function __construct(array $data)
        {
            $this->id    = $data['id'];
            $this->code  = $data['code'];
            $this->name  = $data['name'];
            $this->state = $data['state'];
        }
        function getId() {
            return $this->id;
        }
        function getCode() {
            return $this->code;
        }
        function getName() {
            return $this->name;
        }
        function getState() {
            return $this->state;
        }
        public function jsonSerialize() {
            return get_object_vars($this);
        }
    }
?>
