Testable Drupal
===========

A simple set of tools and files to make your Drupal Installation a Testable Drupal Installation.
Based on Behat, Mink and using Selenium2, Phantomjs and CasperJs, Testable Drupal provide a basic structure to integrate with your tests.

### What it does
At this time Testable Drupal has basic tests to
* verify Drupal installation. - using Mink and CasperJs
* to perform a screenshot when required or when a test fail (if you are not using Goutte). - Using Mink
* to perform a 'node create' and 'node update' with interface interaction (waiting for the appearance of the menu, then click... etc). - Using CasperJs

### Integration are welcome :)

### Components and requirements
* [Composer](https://getcomposer.org)
* An installation of [Drupal](https://drupal.org/) (your installation). I have worked with Drupal 7.22
* [Drush](http://drush.ws/) 
* [drupal-extension](https://github.com/jhedstrom/drupalextension) - provided by composer
* [Behat](http://behat.org/) - provided by composer
* [Mink](http://mink.behat.org/index.html) with extension for Goutte, Mink and Selenium drivers - provided by composer
* [Selenium2](http://docs.seleniumhq.org/)
* [PhantomJs](http://phantomjs.org/)
* [CasperJs](http://casperjs.org/) 

### Component installation
1. Install and configure your Drupal installation

2. Download Composer in the root of your project
```
    curl -s https://getcomposer.org/installer | php
```    

3. If not present create in the root of your project a file with name composer.json with this content:
```
    {
        "require": {
            "vincenzodibiaggio/testable-drupal": "*"
        },
        "minimum-stability": "dev",
        "config": {
            "bin-dir": "bin/"
        }
    }
```   

4. Download dependencies in your project directory
```
    php composer.phar install
```
5. Download [Selenium server](http://docs.seleniumhq.org/download/) 

6. Download [PhantomJs](http://phantomjs.org/download.html)

7. Download [CasperJs](http://casperjs.org/) - Pay attention: to use all of feature the minimum version is 1.1-beta1 !

8. Puth both PhantomJs and CasperJs executables in your PATH

## Configuration

Now Testable Drupal support two test suite
1. 'PHP': Behat/Mink/Selenium/PhantomJs using deep Drupal integration
2. 'JS': PhantomJs/CasperJs to deep interface behavior testing

### Testable Drupal 'PHP'

#### Configuration
1. Modify paths and host in ```tests/behat_dist.yml``` : ```wd_host``` , ```root```, ```drupal_root```
2. If you want you can rename ```behat_dist.yml``` in ```behat.yml``` but if you launch ```behat --init``` you overwrite it!

(if you launch a ```behat --init``` for error you can use the ```FeatureContext_dist.php``` to replace the new file)
        
#### Run suite

1. Run Selenium2
```
    java -jar selenium-server-standalone-YOUR_VERSION.jar -role hub
```

2. Run PhantomJs
```
    phantomjs --webdriver=8080 --webdriver-selenium-grid-hub=http://127.0.0.1:4444
```

3. Run tests
```
    cd vendor/vincenzodibiaggio/testable-drupal/tests
    ./../../../../bin/behat --config behat_dist.yml features/test.feature
```

### Testable Drupal 'JS'

#### Configuration
1. Modify values in ```testable-drupal/jsTests/includes/includeCasper.js``` - I'm working in a better integration with Drupal

I recommend to you: put both PhantomJs and CasperJs executables in your PATH. They work fine together without configuration ;)
        
#### Run suite

1. Just run the test:
(if you respect the order of filenames you will create nodes and make other test on it... otherwise you will test a failure :D )
```
    cd vendor/vincenzodibiaggio/testable-drupal/jsTests
    casperjs test FILENAME
```

