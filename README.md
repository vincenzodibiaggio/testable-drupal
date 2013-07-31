Testable Drupal
===========

A simple set of tools and files to make your Drupal Installation a Testable Drupal Installation.
Based on Behat, Mink and using Selenium2 and Phantomjs, provide a basic structure to integrate with your tests.

At this time "Testable Drupal" has basic tests to verify the operation and to perform a screenshot when required or when a test fail (if you are not using Goutte).

Integration are welcome :)

### Components and requirements
* [Composer](https://getcomposer.org)
* An installation of [Drupal](https://drupal.org/) (your installation). I have worked with Drupal 7.22
* [Drush](http://drush.ws/) 
* [drupal-extension](https://github.com/jhedstrom/drupalextension) - provided by composer
* Behat - provided by composer
* Mink with extension for Goutte, Mink and Selenium drivers - provided by composer
* Selenium2
* PhantomJs

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

### Configuration

1. Modify paths and host in ```tests/behat_dist.yml``` : ```wd_host``` , ```root```, ```drupal_root```
2. If you want you can rename ```behat_dist.yml``` in ```behat.yml``` but if you launch ```behat --init``` you overwrite it!

(if you launch a ```behat --init``` for error you can use the ```FeatureContext_dist.php``` to replace the new file)
        
### Run suite

1. Launch Selenium2
```
    java -jar selenium-server-standalone-YOUR_VERSION.jar -role hub
```

2. Launch PhantomJs
```
    ./phantomjs --webdriver=8080 --webdriver-selenium-grid-hub=http://127.0.0.1:4444
```

3. Launch tests
```
    cd vendor/vincenzodibiaggio/testable-drupal/tests
    ./../../../../bin/behat --config behat_dist.yml features/test.feature
```


