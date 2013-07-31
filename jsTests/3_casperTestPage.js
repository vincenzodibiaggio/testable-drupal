phantom.injectJs('includes/includes.js');
phantom.injectJs('includes/includeCasper.js');


casper.test.begin('Basic BDD: login as Admin and create a Node.', 5, function suite(test) {
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
        this.clickLabel('Add content', 'a');
        
    });
    
    casper.then(function() {
        console.log('clicked on \'Add content\', new location is ' + this.getCurrentUrl());
        this.clickLabel('Article', 'a');
    });
    
    casper.then(function() {
        console.log('clicked ok, new location is ' + this.getCurrentUrl());
        this.fill('form#article-node-form', {
            title: "Super test with Casper",
            'body[und][0][value]': "bla bla bla"
        }, true);
        
    });
    
    casper.then(function() {
        console.log('form submitted, new location is ' + this.getCurrentUrl());
        test.assertVisible('div.status');
        test.assertTextExists('Article Super test with Casper has been created.', 'page body contains message about content created');
        
    });

    casper.run(function() {
        test.done();
        phantom.exit();
    });
});

