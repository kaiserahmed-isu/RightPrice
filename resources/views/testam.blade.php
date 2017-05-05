<?php

//iPP9Podrn4Cn5s4RXqZxQEOe7QQEzeMOsNJDMQ7P
// AKIAJGJBKAL7PJDMMEQA
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;
use ApaiIO\ResponseTransformer;


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
$search->setCategory('Electronics');
//$search->setActor('Bruce Willis');
$search->setKeywords('Dell Laptop');
$search->setPage(1);
$search->setSort('reviewrank');
$search->setResponseGroup(array('Large', 'Small'));

$formattedResponse = $apaiIO->runOperation($search);

//print_r ($formattedResponse["Items"]["Item"]);
var_dump ($formattedResponse);

$output = array();
// $data = array(
//   'TotalPages' => $formattedResponse["Items"]["TotalPages"],
//   'TotalResults' => $formattedResponse["Items"]["TotalResults"],
//   'ItemSearchRequest' => $formattedResponse["Items"]["Request"]["ItemSearchRequest"]
// );
// array_push($output, $data);
//         foreach ($formattedResponse["Items"]["Item"] as $element) {
//           $asin = $element["ASIN"];
//           $detailPageUrl = $element["DetailPageURL"];
//           if (array_key_exists('LargeImage', $element)) {
//               $largeImageUrl = $element["LargeImage"]["URL"];
//           }
//
//           $title = $element["ItemAttributes"]["Title"];
//           if (array_key_exists('ItemAttributes', $element)) {
//                 if (array_key_exists('ListPrice', $element["ItemAttributes"]))
//                   $price = $element["ItemAttributes"]["ListPrice"]["FormattedPrice"];
//           }
//
//
//             if (true === empty($title) || true === empty($asin)) {
//                 continue;
//             }
//             $data["items"] = array(
//                 'title' => (mb_strlen($title) > 30) ?  substr($title,0, 30) : $title,
//                 'url' => $detailPageUrl,
//                 'img' => $largeImageUrl,
//                 'price' => $price,
//                 'asin' => $asin
//             );
//             array_push($output, $data);
//         }
//
// print_r ($output);
