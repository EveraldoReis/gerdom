<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

/**
 * Description of Utils
 *
 * @author webdev
 */
class Utils
{

    //put your code here

    public static function camelize($word)
    {
        $word = explode(' ', $word);
        $word = array_map('ucfirst', $word);
        $word = implode($word);
        return $word;
    }

    public static function confirm($message)
    {
        echo "$message";
        $input = trim(fgets(STDIN));
        echo "\n";
        if (!preg_match('/((y(es)?)|(s(im)?))/i', $input)) {
            return false;
        }
        return true;
    }

    public static function setWarning($message, $type = 'info')
    {
        if (!isset($_SESSION['warning'])) {
            $_SESSION['warning'] = array();
        }
        $_SESSION['warning'][$type] = $message;
    }

    public static function getWarning($type = 'info')
    {
        if (isset($_SESSION['warning'][$type])) {
            $warning = $_SESSION['warning'][$type];
            unset($_SESSION['warning'][$type]);
            return "<div class=\"alert alert-$type\">$warning</div>";
        }
    }

    public static function stringToURL($string)
    {
        $replaces = array('/[âãàáä]+/i' => 'a');
        $replaces = array('/[êẽèéë]+/i' => 'e');
        $replaces = array('/[ĩîíìï]+/i' => 'i');
        $replaces = array('/[õôóòö]+/i' => 'o');
        $replaces = array('/[ũûúùü]+/i' => 'u');
        $replaces = array('/[ç]+/i' => 'c');
        $replaces = array('/[!@#$%¬&*\(\)+=§°\/\?ªº\{\}\[\];:., \r\t\b\n\f\\><]+/i' => '-');
        return preg_replace(array_keys($replaces), $replaces, $string);
    }

    public static function RemoveDir($file)
    {
        if (file_exists($file)) {
            if (is_dir($file)) {
                if ($dd = opendir($file)) {
                    while (false !== ($Arq = readdir($dd))) {
                        if ($Arq != "." && $Arq != "..") {
                            $Path = "$file/$Arq";
                            if (is_dir($Path)) {
                                self::RemoveDir($Path);
                            } elseif (is_file($Path)) {
                                unlink($Path);
                            }
                        }
                    }
                    closedir($dd);
                }
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }

}
