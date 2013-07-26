<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
  
    private $output;

    /** @Given /^I am in a directory "([^"]*)"$/ */
    public function iAmInADirectory($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chdir($dir);
    }

    /** @Given /^I have a file named "([^"]*)"$/ */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }

    /** @When /^I run "([^"]*)"$/ */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /** @Then /^I should get:$/ */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->output) {
            throw new Exception(
                "Actual output is:\n" . $this->output
            );
        }
    }
}
