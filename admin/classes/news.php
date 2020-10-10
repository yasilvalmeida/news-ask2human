<?php
    class News implements JsonSerializable {
        private $title;
        private $date;
        private $image;
        private $url;
        private $source;
        function __construct(array $data) {
            $this->title  = $data['title'];
            $this->date   = $data['date'];
            $this->image  = $data['image'];
            $this->url    = $data['url'];
            $this->source = $data['source'];
        }
        function getTitle() {
            return $this->title;
        }
        function getDate() {
            return $this->date;
        }
        function getImage() {
            return $this->image;
        }
        function getURL() {
            return $this->url;
        }
        function getSource() {
            return $this->source;
        }
        public function jsonSerialize() {
            return get_object_vars($this);
        }
    }
?>
