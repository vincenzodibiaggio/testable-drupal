phantom.injectJs('includes/includes.js');
phantom.injectJs('includes/includeCasper.js');

casper.test.begin('Basic BDD: login as Admin and test behavior of interface.', 6, function suite(test) {
    
    casper.start(_baseUrl , function() {
        test.assertTitle("drupalbehat.dev", "homepage title is ok");
        test.assertExists('form#user-login-form', "user login form is found");
        this.fill('form#user-login-form', {
            name: _adminUser,
            pass: _adminPass
        }, true);
    });

    casper.then(function() {
        test.assertTextExists('Log out', 'User is logged in');
        console.log('location is ' + this.getCurrentUrl());
        this.thenClick(x('/html/body/div[3]/div/div[2]/div/div[2]/div/div[2]/div/div/div/div/a'), function() {
            
            this.capture(_screenshotsPath + 'menu_while_open.png', {
                top: 0,
                left: 0,
                width: _viewPortW,
                height: _viewPortH
            });
        });
        console.log('clicked a \'Configure\' link and maked a screenshot');
        this.waitUntilVisible(x('/html/body/div[3]/div/div[2]/div/div[2]/div/div[2]/div/div/div/div/ul/li/a'));
        console.log('menu for node editing is visible, click it');
        this.thenClick(x('/html/body/div[3]/div/div[2]/div/div[2]/div/div[2]/div/div/div/div/ul/li/a'), function() {
            
            this.capture(_screenshotsPath + 'editing_form.png', {
                top: 0,
                left: 0,
                width: _viewPortW,
                height: _viewPortH
            });
        });        
    });
    
    casper.then(function() {
        test.assertExists('form#article-node-form', "form for node edit was found");
        console.log('location is ' + this.getCurrentUrl());
        var oldTitle = this.getFormValues('form#article-node-form').title;
        this.fill('form#article-node-form', {
            title: oldTitle + " updated",
            'body[und][0][value]': "new body content"
        }, true);
    });
    
    casper.then(function() {
        test.assertVisible('div.status');
        console.log('form submitted, new location is ' + this.getCurrentUrl());
        test.assertTextExists('Article Super test with Casper updated has been updated.', 'page body contains message about content updated');
        
    });
    
    
    casper.run(function() {
        test.done();
        phantom.exit();
    });
});

