<?php
require_once 'config.local.php';
require_once 'PHPUnit/Framework.php';

PHPUnit_Util_Filter::addDirectoryToWhitelist(realpath(dirname(__FILE__) . '/../src/'));

class PrepareTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {

    }
    
    function createPrepare() {
        require_once '../src/Ilib/Payment/Html/Provider/Quickpay/Prepare.php';
        return new Ilib_Payment_Html_Provider_Quickpay_Prepare('merchant', 'verification', 'session');
    }

    function testConstructor()
    {
        $prepare = $this->createPrepare();
        $this->assertTrue(is_object($prepare));
    }
    
    function testGetPostFields() {
        $prepare = $this->createPrepare();
        $prepare->setPaymentValues(1, 100.00, 'DKK', 'DK', 'http://localhosts/ok', 'http://localhosts/error', 'http://localhosts/result', 'http://localhosts/input');
        $prepare->setOptionalValues(array('var1' => 10, 'var2' => 20));
        
        $expected = '<input type="hidden" name="language" value="DK" />' .
                '<input type="hidden" name="merchant" value="merchant" />' .
                '<input type="hidden" name="autocapture" value="0" />' .
                '<input type="hidden" name="ordernum" value="0001" />' .
                '<input type="hidden" name="amount" value="10000" />' .
                '<input type="hidden" name="currency" value="DKK" />' .
                '<input type="hidden" name="okpage" value="http://localhosts/ok" />' .
                '<input type="hidden" name="errorpage" value="http://localhosts/error" />' .
                '<input type="hidden" name="resultpage" value="http://localhosts/result" />' .
                '<input type="hidden" name="ccipage" value="http://localhosts/input" />' .
                '<input type="hidden" name="md5checkV2" value="9a532818bad3d07fb59e298c4c6157aa" />' .
                '<input type="hidden" name="CUSTOM_var1" value="10" />' .
                '<input type="hidden" name="CUSTOM_var2" value="20" />';
        
        
        
        $this->assertEquals($expected, $prepare->getPostFields());
         
    }
}
?>