<?php

namespace Entity;

class Image extends AbstractFile  { 
    
    protected $table_name = 'images';

    protected $allowed_mime_types = array ( 'image/jpeg',
                                          'image/gif',
                                          'image/png');

    public function __construct($db, array $newFile) {
        parent::__construct($db, $this->table_name, $newFile, $this->allowed_mime_types);
    }
}
