<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;
use ApaiIO\ResponseTransformer;
use emanueleminotto;
//iPP9Podrn4Cn5s4RXqZxQEOe7QQEzeMOsNJDMQ7P
// AKIAJGJBKAL7PJDMMEQA

class AmazonController extends Controller
{

    public function search(Request $requestTerm)
    {
      $conf = new GenericConfiguration();
      $client = new \GuzzleHttp\Client();
      $request = new \ApaiIO\Request\GuzzleRequest($client);
      $xmltoarray = new \ApaiIO\ResponseTransformer\xmltoarray();

      $conf
      ->setCountry('com')
      ->setAccessKey('AKIAJGJBKAL7PJDMMEQA')
      ->setSecretKey('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')
      ->setAssociateTag('iceage0c-20')
      ->setResponseTransformer($xmltoarray)
      ->setRequest($request);
      $apaiIO = new ApaiIO($conf);

      $search = new Search();
      // $search->setCategory('All');
      $search->setCategory($requestTerm->cat);
      //$search->setActor('Bruce Willis');
      $search->setKeywords($requestTerm->term);
      $search->setPage(1);
      // $search->setSort('price');
      $search->setResponseGroup(array('Large', 'Small'));

      $formattedResponse = $apaiIO->runOperation($search);

    //  print_r ($formattedResponse);

      $output = array();
      $items = array();
      if ($formattedResponse["Items"]["Request"]["IsValid"] == "True") {
              foreach ($formattedResponse["Items"]["Item"] as $element) {
                $asin = $element["ASIN"];
                $detailPageUrl = $element["DetailPageURL"];
                if (array_key_exists('LargeImage', $element)) {
                    $largeImageUrl = $element["LargeImage"]["URL"];
                }
                if (array_key_exists('CustomerReviews', $element)) {
                  if($element["CustomerReviews"]["HasReviews"] == "true")
                    $reviewURL = $element["CustomerReviews"]["IFrameURL"];
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_HEADER, 0);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
                    curl_setopt($curl, CURLOPT_URL,$reviewURL );
                    $html=curl_exec($curl);
                    // $dom = htmlentities(HtmlDomParser::file_get_html( $html )->find('div.crIFrameHeaderLeftColumn')[0]);
                    $dom = new \simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
                    $html=$dom->load($html, true, true);


                    // Find all images
                    $ret = $html->find('div.crIFrameNumCustReviews',0);

                }

                $title = $element["ItemAttributes"]["Title"];
                if (array_key_exists('ItemAttributes', $element)) {
                      if (array_key_exists('ListPrice', $element["ItemAttributes"]))
                        $price = $element["ItemAttributes"]["ListPrice"]["FormattedPrice"];
                }


                  if (true === empty($title) || true === empty($asin)) {
                      continue;
                  }
                  $item = array(
                      'title' => (mb_strlen($title) > 50) ?  substr($title,0, 50) : $title,
                      'url' => $detailPageUrl,
                      'img' => $largeImageUrl,
                      'review' => $ret,
                      'price' => $price,
                      'asin' => $asin
                  );
                  array_push($items, $item);
              }

              //print_r ($output);
              $data["items"] = $items;
              $data["summary"] = array(
                'TotalPages' => $formattedResponse["Items"]["TotalPages"],
                'TotalResults' => $formattedResponse["Items"]["TotalResults"],
                'ItemSearchRequest' => $formattedResponse["Items"]["Request"]["ItemSearchRequest"]
              );
              array_push($output, $data);


        return view('amazon', ['output' => $output[0]]);
    }
    else{
      return view('noproduct');
  }

  }
}
