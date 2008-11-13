<?php
require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'Ilib/ClassLoader.php';

PHPUnit_Util_Filter::addDirectoryToWhitelist(realpath(dirname(__FILE__) . '/../src/'));
PHPUnit_Util_Filter::removeFileFromWhitelist(realpath(dirname(__FILE__) . '/../src/Ilib/Payment/Html/Provider/Quickpay/templates/').'/payment-input-tpl.php');

class AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Ilib_Payment_Html_Provider_Quicpay');

        $tests = array('Prepare', 'Postprocess');

        foreach ($tests AS $test) {
            require_once $test . 'Test.php';
            $suite->addTestSuite($test . 'Test');
        }

        return $suite;
    }
}
?>