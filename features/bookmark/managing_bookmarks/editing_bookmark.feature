@managing_bookmarks
Feature: Editing bookmark
    In order to change bookmark details
    As a Visitor
    I want to be able to edit a bookmark

    @ui
    Scenario: Changing the bookmark url
        Given there is a bookmark titled "Star Wars"
        And I want to modify the "Star Wars" bookmark
        When I change its url to "http://www.flickr.com/photos/bees/2341623661/"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And I should see the bookmark "ZB8T0193" in the list
        But there should not be "Star Wars" bookmark anymore
