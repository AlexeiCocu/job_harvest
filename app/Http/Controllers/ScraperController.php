<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ScraperController extends Controller
{

    public function web_scraper(Request $request)
    {

        //update DB job list
        if ($request->update_btn == true) {
            DB::table('c_v_s')->delete();

            $client = new Client();
            $url = 'https://www.bestjobs.eu/ro/locuri-de-munca?location=bucuresti&keyword=symfony';
            $page = $client->request('GET', $url);
//            $test = Http::get($url)->body();
//            dd($test);
            $page->filter('.js-card-link')->each(function ($node) {
                $href = $node->extract(array('href'));

                $client = new Client();
                $url = $href[0];
                $page = $client->request('GET', $url);

                $to_db = [
                    'title' => $page->filter('.h4')->text(),
                    'company' => $page->filter('h3')->text(),
                    'location' => $page->filter('div.col-md-9.pl-6.pl-md-3 > a')->text(),
                    'description' => $page->filter('.job-description')->text(),
                    'job_rating' => $page->filter('div.text-nowrap.text-muted > span')->attr('title'),
                ];

                Job::query()->create(mb_convert_encoding($to_db, 'UTF-8', 'UTF-8'));

            });
        }
        // EBD update DB job list

        // full text search
        if ($request->search_full_text == true) {

            $q = $request->query_val;

            $test_query = "SELECT title,location,description,company,job_rating,
            MATCH(title,location,description,company,job_rating)
            AGAINST ('$q' IN NATURAL LANGUAGE MODE)
            AS score FROM jobs WHERE
            MATCH (title,location,description,company,job_rating)
            AGAINST
            ('$q' IN NATURAL LANGUAGE MODE) ORDER BY score DESC";
            $jobs = DB::select($test_query);



//            $jobs = Job::query()->whereRaw(
//                "MATCH (title, location, description) AGAINST (? IN NATURAL LANGUAGE MODE)",
//                array($q)
//            )
//                ->orderBy('job_rating', 'desc')
//                ->get();


            return view('job_search_results', compact('jobs'))->render();
        }
        // end full text search


        return view('web_scraper');
    }
}
