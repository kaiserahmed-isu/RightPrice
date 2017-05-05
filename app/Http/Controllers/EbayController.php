<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Finding\Services;
use \DTS\eBaySDK\Finding\Types;
use \DTS\eBaySDK\Finding\Enums;

class EbayController extends Controller
{
  public function search(Request $requestPost)
  {
    /**
     * Create the service object.
     */
    $service = new Services\FindingService([
        'globalId'    => Constants\GlobalIds::US
    ]);
    /**
     * Create the request object.
     */
    $request = new Types\FindItemsByKeywordsRequest();
    /**
     * Assign the keywords.
     */
    $request->keywords = $requestPost->title;

    $request->sortOrder = "PricePlusShippingLowest";
    /**
     * Send the request.
     */
    $response = $service->findItemsByKeywords($request);
    /**
     * Output the result of the search.
     */
    if (isset($response->errorMessage)) {
        foreach ($response->errorMessage->error as $error) {
            printf(
                "%s: %s\n\n",
                $error->severity=== Enums\ErrorSeverity::C_ERROR ? 'Error' : 'Warning',
                $error->message
            );
        }
    }
    if ($response->ack !== 'Failure') {
        foreach ($response->searchResult->item as $item) {
            // printf(
            //     "(%s) %s: %s %.2f\n",
            //     $item->itemId,
            //     $item->title,
            //     $item->sellingStatus->currentPrice->currencyId,
            //     $item->sellingStatus->currentPrice->value
            // );
        }
    }

    return view('ebay', ['output' => $response->searchResult->item]);
  }
}
