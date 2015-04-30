<?php

class Collection
{
    private static function getCollectionsInfo($nodes)
    {
        $collections = array();

        foreach($nodes as $node)
        {
            $image = isset($node->field_simple_image_cdn) && count($node->field_simple_image_cdn) > 0 ? image_style_url('itinerary_route_icon', $node->field_simple_image_cdn['und'][0]['uri']) : 'http://placehold.it/300x300';
            $collections[] = array('title' => $node->title,
                'image' => $image,
                'url' => drupal_get_path_alias('node/'.$node->nid . '/collection'),
                'description' => isset($node->field_collec_description['und'][0]['value']) ? $node->field_collec_description['und'][0]['value'] : '' );
        }

        return $collections;
    }

    private static function getCollections()
    {
        $efq = new EntityFieldQuery();
        $result = $efq->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'collection')
            ->propertyCondition('status', 1)
            ->execute();
        return $result;
    }

    public static function GetAllCollections()
    {
        $result = self::getCollections();
        $collections = array();
        if(isset($result['node']))
        {
            $nodes = node_load_multiple(array_keys($result['node']));
            $collections = self::getCollectionsInfo($nodes);
        }
        return $collections;
    }
}