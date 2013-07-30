Testable Drupal
===========

A simple set of tools and files to make your Drupal Installation a Testable Drupal Installation.
Based on Behat, Mink and using Selenium2 and Phantomjs, provide a basic structure to integrate with your tests.

At this time "Testable Drupal" has basic tests to verify the operation and to perform a screenshot when required or when a test fail (if you are not using Goutte).

Integration are welcome :)

### Components and requirements
* [Composer](https://getcomposer.org)
* A clean installation of Drupal 7.22 (your installation)
* [drupal-extension](https://github.com/jhedstrom/drupalextension) - provided by composer
* Behat - provided by composer
* Mink with extension for Goutte, Mink and Selenium drivers - provided by composer
* Selenium2
* PhantomJs

### Component installation
1. Install and configure your Drupal installation

2. Download Composer
```
    curl -s https://getcomposer.org/installer | php
```    

3. Clone this repo in the root of project
```
    git clone https://github.com/vincenzodibiaggio/testable-drupal.git PATH_OF_YOUR_DRUPAL_INSTALLATION
```   

4. Download Composer and Dependencies in your project directory
```
    php composer.phar install
```
5. Download [Selenium server](http://docs.seleniumhq.org/download/) 

6. Download [PhantomJs](http://phantomjs.org/download.html)  

### Configuration

1. Modify paths and host in ```tests/behat.yml``` : ```wd_host``` , ```root```, ```drupal_root```
        
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
    cd tests
    ../bin/behat features/test.feature 
```


