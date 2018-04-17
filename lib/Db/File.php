<?php 
namespace OCA\Editor\Db;

use JsonSerializable;

use OCP\AppFramework\Db\Entity;

class File extends Entity implements JsonSerializable {

    protected $title;
    protected $content;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}
