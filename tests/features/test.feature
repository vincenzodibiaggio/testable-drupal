Feature: Various Tests to begin implementation
  As a website user
  I need to be able to create users, make login, create content
  
  @api @javascript
  Scenario: Log in as an admin                                  
    Given I am logged in as a user with the "administrator" role
     Then I should not see "Login"
  
  @api @javascript
  Scenario: Log in as a regular user                                 
    Given I am logged in as a user with the "authenticated user" role
    Then I should not see "Login"
    
  @api @javascript
  Scenario: User Creation and post content
    Given I am on "/"
      And I am logged out
      And I am logged in as a user with the "administrator" role
      And I am on "/"
      And I click "Add content"
      And I click "Article"
      And I fill in "edit-title" with "New drupal test"
      And I fill in "edit-body-und-0-value" with "This is a test"
      And I press "Save"
    Then I should see "Article New drupal test has been created."