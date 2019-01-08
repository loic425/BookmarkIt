@managing_bookmarks
Feature: Adding a new bookmark
    In order to extend bookmarks database
    As an Visitor
    I want to add a new bookmark

    @ui
    Scenario: Adding a new video bookmark
        Given I want to create a new bookmark
        When I specify its url as "https://vimeo.com/76979871"
        And I add it
        Then I should be notified that it has been successfully created
        And the bookmark "The New Vimeo Player (You Know, For Videos)" should appear in the website

    @ui
    Scenario: Adding a new photo bookmark
        Given I want to create a new bookmark
        When I specify its url as "http://www.flickr.com/photos/bees/2341623661/"
        And I add it
        Then I should be notified that it has been successfully created
        And the bookmark "ZB8T0193" should appear in the website
