<?php

namespace Edlcdmc\Bundle\CommonBundle\Library;
/**
 * Created by JetBrains PhpStorm.
 * User: Limak
 * Date: 07.10.12
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */
class Tree
{
    static public function CreateHierarchical($rs, $idElementName = 'id', $idParentName = 'parent_id', $keyChildren = '_children_', $rootId = 0)
    {
        // tablice poczatkowe
        $arrHand = array();
        $arrParent = array();

        foreach ($rs as $v) {
            // pobieramy id
            $id = $v[$idElementName];
            // pobieramy id rodzica
            $parent = $v[$idParentName];
            // zapamietujemy id rodzica dla dnaego id
            $arrParent[$id] = $parent;
            if (!isset($arrHand[$id])) {
                // jesli nie mamy jeszcze tablicy dla id to tworzymy
                $arrHand[$id] = array();
            }
            $element = $v;
            $element[$keyChildren] = &$arrHand[$id];
            $parent = $parent?$parent:0;
            if (!isset($arrHand[$parent])) {
                $arrHand[$parent] = array();
            }
            $arrHand[$parent][] = $element;
        }
//        print_r($arrHand);
//        print_r($arrParent);
//        return (isset($arrHand[0]) && !empty($arrHand[0])?$arrHand[0]:array());
        return (isset($arrHand[$rootId]) && !empty($arrHand[$rootId])?$arrHand[$rootId]:array());
    }

     static public function CreateHierarchicalRoot($rs, $rootId)
     {
         return self::CreateHierarchical($rs, 'id', 'parent_id', '_children_', $rootId);
     }

    static public function getNodesFromTree($tree, $elementId)
    {
        foreach($tree as $node){
            if($node['id'] == $elementId){
                return isset($node['_children_'])? $node['_children_'] : array();
            }else{

            }
        }
    }

    /**
     * Pobiera sciezke elementow dla danego id
     * @param array $rs Tablica danych wejsciowych
     * @param integer $idCurrent Id elementu dla ktorego generujemy sciezke
     * @param string $idElementName Nazwa kolumny ID w tablicy wejsciowej
     * @param string $idParentName Nazwa kolumny rodzica w tablicy wejsciowej
     * @return array
     */
    public static function GetRootPathElement($rs, $idCurrent, $idElementName = 'id', $idParentName = 'parent_id')
    {
        // jesli nie podany id to null
        if (!$idCurrent) {
            return null;
        }

        $arrHand = array();
        $arrParent = array();
        foreach ($rs as $v) {
            $nIdElement = $v[$idElementName];
            $nIdParent = $v[$idParentName];
            if ($nIdParent) {
                if (!isset($arrHand[$nIdParent])) {
                    $arrHand[$nIdParent] = array();
                }
                $arrHand[$nIdElement] = array ($v, & $arrHand[$nIdParent]);
            } else {
                $arrHand[$nIdElement] = array ($v, null);
            }
        }
        // jesli nie mamy takiego wpisu to null
        if (!isset($arrHand[$idCurrent]) || empty($arrHand[$idCurrent])) {
            return array();
        }
        // generujemy tablice jednowymiarowa z elementami wejsciowymi ustawionymi w sciezke
        echo "<PRE>";
//        print_r($arrHand);
        echo "</PRE>";

//        $element = $arrHand[$idCurrent];
        $rtt = array();
//        while ($element) {
//            array_unshift($rt, $element[0]);
//            $element = $element[1];
//        }
        foreach($arrHand as $elementt) {
            if(isset($elementt[0]['moduleId'])) {
            if($elementt[0]['moduleId'] > 0) {
                $element = $elementt;
                $rt = array();
                while ($element) {
                    array_unshift($rt, $element[0]);
                    $element = $element[1];
                }
                print_r($rt);
            }
            }
        }

        return $rtt;
    }

    /**
     * Pobiera sciezke elementow dla danego id
     * @param array $rs Tablica danych wejsciowych
     * @param integer $idCurrent Id elementu dla ktorego generujemy sciezke
     * @param string $idElementName Nazwa kolumny ID w tablicy wejsciowej
     * @param string $idParentName Nazwa kolumny rodzica w tablicy wejsciowej
     * @return array
     */
    public static function GetPathElement($rs, $idCurrent, $idElementName = 'id', $idParentName = 'parent_id')
    {
        // jesli nie podany id to null
        if (!$idCurrent) {
            return null;
        }

        $arrHand = array();
        $arrParent = array();
        foreach ($rs as $v) {
            $nIdElement = $v[$idElementName];
            $nIdParent = $v[$idParentName];
            if ($nIdParent) {
                if (!isset($arrHand[$nIdParent])) {
                    $arrHand[$nIdParent] = array();
                }
                $arrHand[$nIdElement] = array ($v, & $arrHand[$nIdParent]);
            } else {
                $arrHand[$nIdElement] = array ($v, null);
            }
        }
        // jesli nie mamy takiego wpisu to null
        if (!isset($arrHand[$idCurrent]) || empty($arrHand[$idCurrent])) {
            return array();
        }
        // generujemy tablice jednowymiarowa z elementami wejsciowymi ustawionymi w sciezke
        $element = $arrHand[$idCurrent];
        $rt = array();
        while ($element) {
            array_unshift($rt, $element[0]);
            $element = $element[1];
        }

        return $rt;
    }
}
