<?php
namespace OCA\Editor\Db;

use OCP\IDbConnection;
use OCP\AppFramework\Db\Mapper;

class FileMapper extends Mapper {

    public function __construct(IDbConnection $db) {
        parent::__construct($db, 'editor_files', '\OCA\Editor\Db\File');
    }

    public function find($id) {
        $sql = 'SELECT * FROM oc_editor_files WHERE id = ?';
        return $this->findEntity($sql, [$id]);
    }

    public function findAll() {
        $sql = 'SELECT * FROM oc_editor_files';
        return $this->findEntities($sql);
    }

}