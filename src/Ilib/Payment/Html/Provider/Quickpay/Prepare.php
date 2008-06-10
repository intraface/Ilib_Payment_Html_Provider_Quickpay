<?php
/**
 * Prepares Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

require_once 'Ilib/Payment/Html/Prepare.php';

class Ilib_Payment_Html_Provider_Quickpay_Prepare extends Ilib_Payment_Html_Prepare
{
    
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $language the language used in the payment
     */
    public function __construct($merchant, $verificaton_key, $session_id)
    {
        parent::__construct($merchant, $verificaton_key, $session_id);
        $this->post_destination = 'https://secure.quickpay.dk/quickpay.php';
    }
    
    /**
     * prepares the payment values into the fields
     *  
     * @return string post fields
     */
    public function getPostFields() 
    {
        
        if(strlen($this->payment_values['order_number']) < 4) {
            $this->payment_values['order_number'] = str_repeat('0', 4-strlen($this->payment_values['order_number'])).$this->payment_values['order_number'];
        }
        
        $this->payment_values['amount'] = round($this->payment_values['amount']*100);
        
        $md5check = md5($this->payment_values['language'].
                '0'.
                $this->payment_values['order_number'].
                $this->payment_values['amount'].
                $this->payment_values['currency'].
                $this->merchant.
                $this->payment_values['okpage'].
                $this->payment_values['errorpage'].
                $this->payment_values['resultpage'].
                $this->payment_values['inputpage'].
                $this->verification_key);
        
        $fields = '<input type="hidden" name="language" value="'.$this->safeToHtml($this->payment_values['language']).'" />'.
            '<input type="hidden" name="merchant" value="'.$this->safeToHtml($this->merchant).'" />'.
            '<input type="hidden" name="autocapture" value="0" />'.
            '<input type="hidden" name="ordernum" value="'.$this->safeToHtml($this->payment_values['order_number']).'" />'.
            '<input type="hidden" name="amount" value="'.$this->safeToHtml($this->payment_values['amount']).'" />'.
            '<input type="hidden" name="currency" value="'.$this->safeToHtml($this->payment_values['currency']).'" />'.
            '<input type="hidden" name="okpage" value="'.$this->safeToHtml($this->payment_values['okpage']).'" />'.
            '<input type="hidden" name="errorpage" value="'.$this->safeToHtml($this->payment_values['errorpage']).'" />'.
            '<input type="hidden" name="resultpage" value="'.$this->safeToHtml($this->payment_values['resultpage']).'" />'.
            '<input type="hidden" name="ccipage" value="'.$this->safeToHtml($this->payment_values['inputpage']).'" />'.
            '<input type="hidden" name="md5checkV2" value="'.$this->safeToHtml($md5check).'" />';
        
        /*
        if(is_array($optional_input)) {
            foreach($optional_input AS $key => $value) {
                $fields .= '<input type="hidden" name="CUSTOM_'.$key.'" value="'.$this->safeToHtml($value).'" />';
            }
        }
        */
        
        return $fields;
    }
    
    /**
     * Returns the name of the provider. Needs to be overridden in extends.
     * 
     * @return string name of provider
     */
    public function getProviderName()
    {
        return 'Quickpay';
    }
}


?>
