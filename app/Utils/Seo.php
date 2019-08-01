<?php

namespace App\Utils;

use Illuminate\Support\Facades\URL;

class SEO
{
    private static $default = array(
        'title' => 'Matrix Feed',
        'content' => 'MATRIXFEED is a website that will provide you the best and most efficient articles about all the topics you are eager to know about. Our motive is to share the information and knowledge to our greatest extent. We have the best brains working for you and your queries.',
        'image' => '/static images/seo-image.png',
        'keywords' => 'MatrixFeed, Best Article Site, Fresh And Updated Article, Matrixfeed, Article On Technology, Article on Bussiness, Article On Education, And Miscellaneous, Devloped your Skill, Rich article,
        Neat and Clean Environment, Genuine Article, Matrix+Feed, feed+Matrix=Matrixfeed, Raghib Sultan, Raza Ali, Irshad Ansari, M47R1XF33D=Matrixfeed',
    );
    private static $siteName = 'Matrix Feed';
    private static $fbId = '365090877489585';
    private static $twitterUsername = '@feed_matrix';

    public static function post($post, $url)
    {
        $fullImgUrl = URL::to('/') . $post->image;
        return self::createObj($post->title, $post->description, $fullImgUrl, $url, $post->keywords, $post->created_at, 'article', false);
    }

    public static function home($url)
    {
        return self::createObj(self::$default['title'], self::$default['content'], env('APP_URL') . '' . self::$default['image'], $url, self::$default['keywords'], null, 'website', false);
    }

    public static function minimal($title)
    {
        return self::createObj($title, self::$default['content'], null, null, null, null, 'website', true);
    }

    public static function createObj($title, $content, $image, $url, $keywords, $date, $type, $isMinimal)
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
            'keywords' => $keywords,
            'date' => null,
            'isMinimal' => $isMinimal,
        );

        if ($date) {
            $SEO['date'] = $date;
        }

        return $SEO;
    }
}
