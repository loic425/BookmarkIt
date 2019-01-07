@managing_bookmarks
Feature: Adding a new bookmark
    In order to extend bookmarks database
    As an Visitor
    I want to add a new bookmark

    @ui
    Scenario: Adding a new video bookmark
        Given I want to create a new video bookmark
        When I specify its title as "Star Wars"
        And I specify its url as "http://example.com/star-wars"
        And I specify its author name as "George Lucas"
        And I specify its width as 1920
        And I specify its height as 1200
        And I specify its duration as 180
        And I add it
        Then I should be notified that it has been successfully created
        And the bookmark "Star Wars" should appear in the website

    @ui
    Scenario: Adding a new photo bookmark
        Given I want to create a new photo bookmark
        When I specify its title as "Star Wars"
        And I specify its url as "http://example.com/star-wars"
        And I specify its author name as "George Lucas"
        And I specify its width as 1920
        And I specify its height as 1200
        And I add it
        Then I should be notified that it has been successfully created
        And the bookmark "Star Wars" should appear in the website
