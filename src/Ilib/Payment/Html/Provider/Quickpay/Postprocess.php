<?php
/**
 * Postprocess Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

require_once 'Ilib/Payment/Html/Postprocess.php';

class Ilib_Payment_Html_Provider_Quickpay_Postprocess extends Ilib_Payment_Html_Postprocess
{
    
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $language the language used in the payment
     */
    public function __construct($merchant, $verification_key, $session_id)
    {    
        parent::__construct($merchant, $verification_key, $session_id);
    }
    
    public function setPaymentResponse($input) {
        
        /**
         * amount Beløb i mindste enhed (DKK: 1 kr skrives som 100 øre)
         * time Format: yymmddhhmmss
         * ordernum Ordrenummeret på den/de vare kunden køber
         * pbsstat Statuskode returneret fra PBS.
         * qpstat Statuskode. Statuskoder.
         * qpstatmsg En tekstbesked, der uddyber fejlkoden i qpstat.
         * merchantemail Forhandler-email som transaktionen er autoriseret til.
         * merchant Forhandlernavn som transaktionen er autoriseret til.
         * currency Valuta enhed. Typer.
         * cardtype Korttype anvendt ved betalingen.
         * transaction ID på transaktionen som skal anvendes ved fx. capture.
         * md5checkV2 md5(concat(amount, time, ordernum, pbsstat, qpstat, qpstatmsg, merchantemail, merchant, currency, cardtype, transaction, md5secret)).
         */
        
        // without md5checkV2
        $payment_vars = array('amount', 'time', 'ordernum', 'pbsstat', 'qpstat', 'qpstatmsg', 'merchantemail', 'merchant', 'currency', 'cardtype', 'transaction');
        $md5_string = '';
        
        foreach($payment_vars AS $var) {
            if(empty($input[$var]) ) {
                throw new Exception('the value '.$var.' is missing!');
                return false;
            }
            $md5_string .= $input[$var];
        }
        
        $md5_string .= $this->verification_key;
        // die(md5($md5_string));
        
        if(empty($input['md5checkV2']) || $input['md5checkV2'] != md5($md5_string)) {
            throw new Exception('Check for md5 value failed!');
            return false;
        }
        
        if($input['qpstat'] != '000') {
            // We try to log the error, but this could probably gives to many items in our log.
            throw new Exception('The payment was not accepted');
        }
        
        $this->values['amount'] = ($input['amount']/100);
        $this->values['order_number'] = $input['ordernum'];
        $this->values['pbs_status'] = $input['pbsstat'];
        $this->values['transaction_id'] = $input['transaction'];
        
        foreach($input AS $key => $optional) {
            if(substr($key, 0, 7) == 'CUSTOM_') {
                $this->optional_values[substr($key, 7)] = $optional;
            }
        }
        
        return true;
    } 
}


?>