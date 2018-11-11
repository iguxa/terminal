<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 10.11.18
 * Time: 19:11
 */

namespace App;


class UploadImage
{
    use SingletonTrait;

    public $files;

    protected $quality;
    protected $percent;
    protected $size;
    protected $dir_upload;
    protected $name_form;
    protected $uploaded_files = [];

    public function init($data = null)
    {
        $images_config = Confing::getConfig('images_params');
        $this->quality = $images_config['quality'];
        $this->percent = $images_config['percent'];
        $this->size = $images_config['size'];
        $this->dir_upload = $images_config['dir_upload'];
        $this->name_form = $images_config['name_form'];
    }

    protected function prepare(): ?string
    {
        $files = $this->files;
        if(key($files) == 'array'){
            foreach ($files['array']['type'] as $key => $type){
                if($type != 'image/jpeg'){
                    return  'не правильный тип файла '.$files['array']['name'][$key].' можно грузить только jpeg';
                }
            }
            foreach ($files['array']['size'] as $key => $size){
                if($size > $this->size){
                    return  'превышен размер '.$files['array']['name'][$key].' размер : '.round($size/1024/1024, 2).'mb максимальный размер: '.round($this->size/1024/1024, 2).'mb';
                }
            }
            foreach ($files['array']['error'] as $key => $error){
                if($error){
                    return  'ошибка загрузки '.$files['array']['name'][$key];
                }
            }
            foreach ($files['array']['tmp_name'] as $filename){
                $upload = $this->upload($filename);
                if(!$upload){
                    return  'не известная ошибка,при загрузке';
                }
            }
        }else{
            if($files[$this->name_form]['type'] != 'image/jpeg'){
                return  'не правильный тип файла '.$files[$this->name_form]['name'].' можно грузить только jpeg';
            }
            if($files[$this->name_form]['size'] > $this->size){
                return  'превышен размер '.$files[$this->name_form]['name'].' размер : '.round($files[$this->name_form]['size']/1024/1024, 2).'mb максимальный размер: '.round($this->size/1024/1024, 2).'mb';
            }
            if($files[$this->name_form]['error']){
                return  'ошибка загрузки '.$files[$this->name_form]['error'];
            }
            $upload = $this->upload($files[$this->name_form]['tmp_name']);
            if(!$upload){
                return  'не известная ошибка,при загрузке';
            }
        }

        return 'success';
    }
    public function load(array $files): ?array
    {

        if(!$files){
            return null;
        }
        $this->files = $files;
        $status = $this->prepare();
         if($status == 'success'){
             $message['status'] = $status;
             $message['uploaded_files'] = $this->uploaded_files;
         }else{
             $message['status'] = 'fail';
             $message['uploaded_files'] = $status;
         }
         return $message;
    }

    protected function upload(string $filename): bool
    {
       $name = 'IMG_'.date("Ymd").'_'.time().'_'.rand(1,999).'.jpg';
       $uploadfile = $this->dir_upload.$name;
       $percent = $this->percent;
       $quality = $this->quality;

        // получение новых размеров
       list($width, $height) = getimagesize($filename);
       $new_width = $width * $percent;
       $new_height = $height * $percent;

        // ресэмплирование
       $image_p = imagecreatetruecolor($new_width, $new_height);
       $image = imagecreatefromjpeg($filename);
       imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);


        // вывод
        $upload = imagejpeg($image_p, $uploadfile, $quality);
        if($upload){
            $this->uploaded_files[] = $name;
        }
        return $upload;
     }
}