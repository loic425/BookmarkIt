@managing_bookmarks
Feature: Deleting a bookmark
    In order to get rid of deprecated bookmarks
    As a Visitor
    I want to be able to delete bookmarks

    Background:
        Given there is a bookmark titled "Star Wars"

    @ui
    Scenario: Deleting a bookmark
        Given I want to browse bookmarks
        When I delete bookmark with title "Star Wars"
        Then I should be notified that it has been successfully deleted
        And there should not be "Star Wars" bookmark anymore
