<?php
/**
 * File Exchange.php /Services/Exchange/Controller
 *
 * PHP Version 8.1
 *
 * @category Services_Exchange_Controller
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Services\Exchange\Controller;
use App\Controllers\AbstractController;
use App\Providers\Request;
use App\Services\Exchange\Currency\CurrencyBuilder;

/**
 * Exchange manage requests
 *
 * @category Services_Exchange_Controller
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Exchange extends AbstractController
{
    
    /**
     * Receiver request
     *
     * @param string $request from services
     * 
     * @return void
     */
    public function receiver( Request $request ) : void
    {

        $validated = $request->validateRequest();

        if (( isset($validated[ 'error' ]) ) && ( $validated[ 'error' ] ) ) :
            $this->sendResponse(400, $validated[ 'message' ]);
        endif;

        $calcuted = $this->calculate($validated[ 'validatedRequest' ]);
    }
    
    /**
     * Calculate request
     *
     * @param mixed $request to calculted amount and rate
     * 
     * @return void
     */
    protected function calculate( array $request ) : void
    {
        $calculated = floatval($request[ 'amount' ] * $request[ 'rate' ]);
        $currency_builder = new CurrencyBuilder();
        $currency = $currency_builder->build($request['to'], $calculated);

        $response = [
            'valorConvertido' => $currency->getAmount(),
            'simboloMoeda' => $currency->getSymbol()
        ];

        $this->sendResponse(200, $response);
    }

}