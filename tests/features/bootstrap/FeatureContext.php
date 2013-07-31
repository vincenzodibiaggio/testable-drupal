<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
    
use Behat\Behat\Event\StepEvent;

use Drupal\DrupalExtension\Context\DrupalContext;


//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends DrupalContext
{
    private $output;
    private $nodeId;
    
    /**
     * Current authenticated user.
     *
     * A value of FALSE denotes an anonymous user.
     */
    protected $loggedInUser = FALSE;
    
    
    /**
     * Logs out the current user, if logged in.
     *
     * @Given /^I am logged out$/
     */
    public function logout() {
        $this->visit('/user/logout');
    }
    
        
    
    /**
     * Automated Screenshot on fail
     *
     *
     * @AfterStep
     */
    public function afterStep(Behat\Behat\Event\StepEvent $event)
    {
       
       $context = $event->getContext();
       if ($context->getMinkParameter('browser_name') == 'phantomjs' && $event->getResult() == StepEvent::FAILED) {
            $this->iTakeAScreenshotWithName('fail');
       }
    }
    
    /**
    * @Given /^I take a screenshot with name "([^"]*)"$/
    */
    public function iTakeAScreenshotWithName($name)
    {
        if ( 'goutte' !== $this->getSession()->getDriver() )
        {
            $screen = $this->getSession()->getScreenshot();
            $h = fopen('/tmp/'.$name.'.jpg','w');
            fputs ($h, $screen);
            fclose ($h);
        }
        
    }
    
    /**
    * @And /^I wait this time "([^"]*)"$/
    */
    public function iWaitThisTime($time)
    {
        $this->getSession()->wait(5000, false );
    }
    
    
    /**
    * @Then /^I wait for "([^"]*)" element to appear$/
    */
    public function iWaitForElementToAppear($element)
    {
        $this->getSession()->wait(4000, "document.getElementById('$element')");
    }
    
    
    
    /**
    * @When /^I restart the browser$/
    */
    public function iRestartTheBrowser()
    {
        $driver = $this->getSession()->getDriver();
        $session = new \Behat\Mink\Session($driver);
        $session->start();
        $session->visit('/');
    }
    
    
    /** @Given /^I capture id of node from url$/ */
    public function iCaptureIdOfNodeFromUrl()
    {
        $url = $this->getSession()->getCurrentUrl();
        $arrUrl = explode('/', $url);
        
        $this->nodeId = $arrUrl[count($arrUrl)-1];
    }   
}
