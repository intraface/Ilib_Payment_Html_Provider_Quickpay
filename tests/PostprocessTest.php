<?php
require_once 'config.local.php';
require_once 'PHPUnit/Framework.php';

PHPUnit_Util_Filter::addDirectoryToWhitelist(realpath(dirname(__FILE__) . '/../src/'));


class PostprocessTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {

    }
    
    function createPostprocess() {
        require_once '../src/Ilib/Payment/Html/Provider/Quickpay/Postprocess.php';
        return new Ilib_Payment_Html_Provider_Quickpay_Postprocess('merchant', 'verification', 'session');
    }

    function testConstructor()
    {
        $postprocess = $this->createPostprocess();
        $this->assertTrue(is_object($postprocess));
    }
    
    function testSetPaymentResponse() 
    {
        $postprocess = $this->createPostprocess();
        $this->assertTrue($postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605')));
    }
    
    function testGetAmount() {
        $postprocess = $this->createPostprocess();
        $postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605'));
        
        $this->assertEquals(100.00, $postprocess->getAmount());
        
    }
    
    function testGetOrderNumber() {
        $postprocess = $this->createPostprocess();
        $postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605'));
        
        $this->assertEquals(1, $postprocess->getOrderNumber());
        
    }
    
    function testGetPbsStatus() {
        $postprocess = $this->createPostprocess();
        $postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605'));
        
        $this->assertEquals(123, $postprocess->getPbsStatus());
        
    }
    
    function testGetTransactionId() {
        $postprocess = $this->createPostprocess();
        $postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605'));
        
        $this->assertEquals(10, $postprocess->getTransactionId());
        
    }
    
    function testGetOptionalValues() {
        $postprocess = $this->createPostprocess();
        $postprocess->setPaymentResponse(array('amount' => 10000, 'time' => '080101100000', 'ordernum' => 1, 'pbsstat' => 123, 'qpstat' => '000', 'qpstatmsg' => 'valid', 'merchantemail' => 'test@test.dk', 'merchant' => 'merchant', 'currency' => 'DKK', 'cardtype' => 'visa', 'transaction' => 10, 'md5checkV2' => 'd8ed3a808ebea9891eca594cb7b4f605', 'CUSTOM_var1' => 10, 'CUSTOM_var2' => 20));
        
        $this->assertEquals(array('var1' => 10, 'var2' => 20), $postprocess->getOptionalValues());
        
    }
    
    
}
?>