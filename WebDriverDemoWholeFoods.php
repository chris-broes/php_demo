<?php

require_once 'vendor/autoload.php';

class WebDriverDemo extends Sauce\Sausage\WebDriverTestCase
{

    protected $start_url = 'http://www.wholefoodsmarket.com/';

    public static $browsers = array(
        // run FF15 on Windows 8 on Sauce
        array(
            'browserName' => 'firefox',
            'desiredCapabilities' => array(
                'version' => '38',
                'platform' => 'Windows 8.1',
            )
        ),
        // run Chrome on Linux on Sauce
        array(
            'browserName' => 'chrome',
            'desiredCapabilities' => array(
                'platform' => 'Linux',
				'screenResolution' => '1024x768',
          )
        ),
        // run Mobile Safari on iOS
        //array(
            //'browserName' => '',
            //'desiredCapabilities' => array(
                //'app' => 'safari',
                //'device' => 'iPhone Simulator',
                //'version' => '6.1',
                //'platform' => 'Mac 10.8',
            //)
        //)//,
        // run Chrome locally
        //array(
            //'browserName' => 'chrome',
            //'local' => true,
            //'sessionStrategy' => 'shared'
        //)
    );

    public function testTitle()
    {
        $this->assertContains("Whole Foods Market", $this->title());
    }

				// 		    public function testLink()
				// 		    {
				// 		        $this->timeouts()->implicitWait(10000);
				// $link = $this->byClassName('.ugc_img');
				// 		        $link->click();
				// $link = $this->byXpath("//*[contains(@class, 'filter') and contains(text(), 'Food')]");
				// 		        $link->click();
				// $link = $this->byCssSelector('.ugc');
				// $link = $this->byXpath("//*[contains(@class, 'filter') and contains(text(), 'Your Stories')]");
				// 		        $link->click();
				// $this->timeouts()->implicitWait(10000);
				// $this->assertContains("#FOODS4THOUGHT | YOUR STORIES", $this->byClassName('boxes-box-content'));
				// 		    }

		    public function testSubmitEmail()
		    {
				$email = "test@test.com";
		        $this->timeouts()->implicitWait(2000);
				$this->byId('edit-subscription-email')->value($email);
		        $this->byId('edit-submit--2')->submit();
		        $this->timeouts()->implicitWait(2000);
		        $textbox = $this->byId('newsletter-email-input');
				$this->assertEquals($textbox->value(), $email);
			 }

		    public function testForm()
		    {
		        $email = "test@test.com";
		        $state = "California";
				$address = "SoMa - 399 4th Street";
				$this->timeouts()->implicitWait(2000);
				$this->byId('edit-subscription-email')->value($email);
		        $this->byId('edit-submit--2')->submit();
		        $this->timeouts()->implicitWait(2000);
		        $this->byId('newsletter-state-select')->value($state);
				// 		        $this->byId('newsletter-store-select')->value($address);
				$selector = $this->byId('newsletter-state-select');
				$this->assertEquals($selector->value(), "CA");
		    }

}
