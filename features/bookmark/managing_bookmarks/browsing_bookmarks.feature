@managing_bookmarks
Feature: Browsing bookmarks
    In order to manage bookmarks in the website
    As an Visitor
    I want to browse bookmarks

    Background:
        Given there is a bookmark titled "Star Wars"
        And there is also a bookmark titled "Game Of Thrones"
        And there is also a bookmark titled "Back To The Future"

    @ui
    Scenario: Browsing bookmarks in the website
        When I want to browse bookmarks
        Then there should be 3 bookmarks in the list
        And I should see the bookmark "Star Wars" in the list
        And I should see the bookmark "Game Of Thrones" in the list
        And I should see the bookmark "Back To The Future" in the list
