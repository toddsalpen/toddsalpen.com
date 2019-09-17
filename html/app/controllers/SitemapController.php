<?php

use Phalcon\Mvc\Controller;

class SitemapController extends Controller
{
    protected $domain = 'https://www.butlerfly.com';


    public function initialize()
    {

        //for big files, to be on the safe side
        set_time_limit(0);
        $this->view->disable();

    }

    public function indexAction()
    {

        $response = new Phalcon\Http\Response();

        $expireDate = new \DateTime();
        $expireDate->modify('+1 day');

        $response->setExpires($expireDate);

        $response->setHeader('Content-Type', "application/xml; charset=UTF-8");

        $sitemap = new \DOMDocument("1.0", "UTF-8");

        $urlset = $sitemap->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');


        $links = array( "/availability/housekeeping",
            "/availability/moving-help",
            "/availability/disposal",
            "/availability/yard-maintenance",
            "/availability/pickup-and-delivery",
            "/availability/handyman",
            "/contact",
            "/terms",
            "/support"
        );


        $modifiedAt = new \DateTime();
        $modifiedAt->setTimezone(new \DateTimeZone('UTC'));

        $comment = $sitemap->createComment(' Last update of sitemap ' . date("Y-m-d H:i:s").' ');

        $urlset->appendChild($comment);

        $url = $sitemap->createElement('url');
        $href = $this->domain;
        $url->appendChild($sitemap->createElement('loc', $href));
        $url->appendChild($sitemap->createElement('changefreq', 'daily')); //Hourly, daily, weekly etc.
        $url->appendChild($sitemap->createElement('priority', '1.0'));     //1, 0.7, 0.5 ...

        $urlset->appendChild($url);

        foreach ($links as $link) {

            $url = $sitemap->createElement('url');
            $href = $this->domain.$link;
            $url->appendChild($sitemap->createElement('loc', $href));
            $url->appendChild($sitemap->createElement('changefreq', 'daily')); //Hourly, daily, weekly etc.
            $url->appendChild($sitemap->createElement('priority', '0.5'));     //1, 0.7, 0.5 ...

            $urlset->appendChild($url);
        }

        $sitemap->appendChild($urlset);
        $response->setContent($sitemap->saveXML());
        return $response;
    }
}
