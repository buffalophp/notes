<?php

namespace Distort;

use Entity\Image;

class Distort  extends Image { 
    
    protected $image; 

    protected $control_points;

    public function __construct($db, array $newFile ){
        parent::__construct($db, $newFile);
    }

    private function prepare(){
        $this->image = new \Imagick($this->getAbsolutePath());

        $this->control_points = 
            array( 
                60, 60, 60, 30,
                60, $this->image->getImageHeight() - 60, 
                60, $this->image->getImageHeight() - 30,
                $this->image->getImageWidth() - 60, 60,
                $this->image->getImageWidth() - 60,60,
                $this->image->getImageWidth() - 60, 
                $this->image->getImageHeight() - 60,
                $this->image->getImageWidth() - 60, 
                $this->image->getImageHeight() - 60
                );

        $this->image->setImageVirtualPixelMethod(\Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
        $this->image->setImageMatte(true);
    }

    public function doDistortion(){ 

        $this->prepare();
        $this->image->distortImage(\Imagick::DISTORTION_PERSPECTIVE, $this->control_points, true);

        $this->image->scaleImage(400, 400, true);
        unlink($this->getAbsolutePath());
        $this->image->writeImage($this->getAbsolutePath());

        return $this;
    }
}


