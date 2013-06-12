<?php

namespace Entity;

use Db\dbConnection;

abstract class AbstractFile extends AbstractEntity {

    protected $name;

    protected $mime_type;

    protected $size;

    protected $path;

    protected $allowedMimeTypes;

    protected $file;

    public function __construct(dbConnection $db, $table, array $newFile, array $mimeTypes){
        parent::__construct($db, $table);
        
        $this->setName($newFile['name'])
             ->setAllowedMimeTypes($mimeTypes)
             ->setMimeType($newFile['type'])
             ->setSize($newFile['size'])
             ->setFile($newFile['tmp_name']);

    }
    

    protected function getRootUploadDir(){ 
        return __DIR__.'/../../web/assets/'.$this->getUploadDir();
    }

    protected function getUploadDir(){
        return '/uploads';
    }

    protected function move($rootDir, $name){
        
        if (!is_dir($rootDir)){
            if (!@mkdir($rootDir, 0777, true)){
                throw new \Exception(sprintf('Cannot make directory %s', $rootDir));
            }
        } elseif (!is_writable($rootDir)){
            throw new \Exception(sprintf('Cannot write to directory, %s', $rootDir));
        }

        $target = $rootDir.DIRECTORY_SEPARATOR.$name;

        if ( move_uploaded_file($this->getFile(), $target) ){
            @chmod($target, 0666);
            return true;
        }

        return false;

    }

    public function getAbsolutePath(){
        return $this->path === null
            ? null
            : $this->getRootUploadDir(). '/' .$this->getPath();
    }

    public function getWebPath(){
        return $this->path === null
            ? null
            : 'assets'.$this->getUploadDir(). '/' . $this->getPath();
    }

    public function upload(){
        if ($this->getFile() === null){ 
            return;
        }
        if ($this->move($this->getRootUploadDir(), $this->getName())){
            $this->setPath($this->getName())
                 ->setFile(null);
            
            return true;
        }

        return false;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
        
    public function getName() {
        return $this->name;
    }

    public function setMimeType($mime_type) {
        if (in_array($mime_type, $this->getAllowedMimeTypes())){
            $this->mime_type = $mime_type;
            return $this;
        }
        throw new \Exception('File type not found in allowed list of mime types!');
    }
        
    public function getMimeType() {
        return $this->mime_type;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }
        
    public function getSize() {
        return $this->size;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }
        
    public function getPath() {
        return $this->path;
    }
    
    public function getFile(){
        return $this->file;
    }

    public function setFile($file){ 
        $this->file = $file;
        return $this;
    }
    public function getAllowedMimeTypes(){
        return $this->allowedMimeTypes;
    }

    public function setAllowedMimeTypes(array $mimeTypes){ 
        $this->allowedMimeTypes = $mimeTypes;
        return $this;
    }
}
