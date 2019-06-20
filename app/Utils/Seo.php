<?php

namespace App\Utils;

class SEO
{
    private static $default = array(
        'title' => 'Matrix Feed',
        'content' => 'Matrix Feed',
        'image' => '',
        'keywords' => ''
    );
    private static $twitterHandle = '@';
    private static $siteName = 'Matrix Feed';
    private static $fbId = '';
    private static $twitterUsername = '';

    public static function post($post, $url)
    {
        return self::createObj($post->title, $post->body, $post->image, $url, $post->created_at, 'article');
    }

    public static function home($url)
    {
        return self::createObj(self::$default['title'], self::$default['content'], self::$default['image'], $url, null, 'website');
    }

    public static function createObj($title, $content, $image, $url, $date, $type)
    {
        $SEO = array(
            'title' => $title,
            'description' => $content,
            'image' => $image,
            'url' => $url,
            'siteName' => self::$siteName,
            'type' => $type,
            'twitterUsername' => self::$twitterUsername,
            'fbId' => self::$fbId,
            'keywords' => self::$default['keywords'],
            'date' => null
        );

        if ($date) {
            $SEO['date'] = $date;
        }

        return $SEO;
    }
}
