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

		    public function testLink()
		    {
		        $this->timeouts()->implicitWait(10000);
				$link = $this->byCssSelector('html.js body.html.front.not-logged-in.no-sidebars.page-values-matter.atr-7.x-3.x.atv-7.x-3.2.page-views.localstorestorage-processed.lightbox-processed.ss-attach-processed.ajaxNewsletter-processed div#page-wrapper div#page.container.page div#columns.columns.clearfix main#content-column.content-column div.content-inner section#main-content div#content.region div#block-system-main.block.block-system.no-title div.view.view-brand-camp-list.view-id-brand_camp_list.view-display-id-page.view-dom-id-393f52f77cadde5f7bbc7731d2497f38 div.isoFilters div.showme.isoFilters-widget.tablet-widget'); 
		        $link->click();
				$link = $this->byXpath("//*[contains(@class, 'filter') and contains(text(), 'Food')]");
		        $link->click();
				$link = $this->byCssSelector('.ugc');
				$link = $this->byXpath("//*[contains(@class, 'filter') and contains(text(), 'Your Stories')]");
		        $link->click();
				$this->timeouts()->implicitWait(10000);
				$this->assertContains("#FOODS4THOUGHT | YOUR STORIES", $this->byClassName('boxes-box-content'));
		    }

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
		//
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
		        $this->byId('newsletter-store-select')->value($address);
				$selector = $this->byId('newsletter-state-select');
				$this->assertEquals($selector->value(), "CA");
		    }

}
