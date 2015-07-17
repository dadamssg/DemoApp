@user
Feature: User
  In order to manage an account
  As a user
  The endpoints need to function

  Scenario: User can register
    Given an anonymous user
    When they register with valid user data
    Then they get a 201 status code
    And the property "message" exists in the response

  Scenario: User can confirm their account
    Given an anonymous user
    When they visit a valid user confirmation link
    Then they get a 200 status code
    And the property "message" exists in the response