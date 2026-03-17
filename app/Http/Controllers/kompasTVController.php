<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class kompasTVController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->request('GET', 'https://properti.kompas.com/tips-properti');
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);
        $berita = [];

        $crawler->filter('.articleList .articleItem')->each(function ($node) use (&$berita){
            $title = $node->filter('.articleTitle')->text();
            $link = $node->filter('a')->attr('href');
            $date = $node->filter('.articlePost-date')->text();

            $image = null;
            if($node->filter('img')->count() > 0){
                $image = $node->filter('img')->attr('src');
            }

            $berita[] = [
                'date' => $date,
                'title' => $title,
                'link' => $link,
                'image' => $image
            ];
        });

        return view('pages.news', compact('berita'));
    }
}
