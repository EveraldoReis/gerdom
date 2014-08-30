<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

/**
 * Description of Uploader
 *
 * @author webdev
 */
class Uploader
{

    public static $allowedExtensions = array('png', 'jpg', 'jpeg', 'gif', 'svg');
    public static $saveDir;

    //put your code here
    public static function save($dir, array $files)
    {
        $key = key($files);
        static::$saveDir = $dir;
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        if (is_array($files[$key]['name'])) {
            return static::uploadMulti($files[$key]);
        } else {
            return static::uploadSimple($files[$key]);
        }
    }

    public static function uploadMulti($files)
    {
        $return = array();
        foreach ($files['tmp_name'] as $key => $file) {
            if (!empty($file)) {
                $ext = explode('.', $files['name'][$key]);
                $ext = array_pop($ext);
                if (in_array($ext, static::$allowedExtensions)) {
                    move_uploaded_file($files['tmp_name'][$key], static::$saveDir . '/' . $files['name'][$key]);
                    $return[] = str_replace(UPLOAD_DIR, '', static::$saveDir) . '/' . $files['name'][$key];
                } else {
                    throw new \Exception('Arquivo não permitido');
                }
            }
        }
        return $return;
    }

}
