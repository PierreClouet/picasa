<?php
/**
 * Created by PhpStorm.
 * User: audemard
 * Date: 25/10/2015
 * Time: 08:25
 */

namespace Helpers;


class HTML {

    private static function options($options) {
        $ret = "";
        foreach($options as $att=>$val)
            $ret = $ret."$att='$val' ";
        return $ret;
    }


    public static function lien($link,$aff,$options=array()) {
        $o = HTML::options($options);
        return "<a href='$link' $o>$aff</a>";
    }

    public function table($tab,$ent) {
        $res = "<table><tr>";
        foreach($ent as $e) {
            $res.="<th>$e</th>";
        }
        $res .="</tr>\n";

        foreach($tab as $ligne) {
            $res = $res."<tr>";
            foreach($ligne as $cellule) {
                $res = $res."<td>$cellule</td>";
            }

            $res = $res."</tr>\n";

        }

        $res=$res."</table>";
        return $res;
    }

    public static function input($type,$name,$options=array()) {
        $o = HTML::options($options);
        return "<input type='$type' name='$name' $o />";
    }


    public static function select($name,$select,$options=array()) {
        $o = HTML::options($options);
        $ret = "<select name='$name' $o>";
        foreach($select as $k=>$aff) {
            $ret = $ret."<option value='$k'>$aff</option>";
        }
        return $ret."</select>";
    }

    public static function img($src,$alt='') {
        return "<img src='$src' alt='$alt' />";
    }

}