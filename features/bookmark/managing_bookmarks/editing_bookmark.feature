@managing_bookmarks
Feature: Editing bookmark
    In order to change bookmark details
    As an Visitor
    I want to be able to edit a bookmark

    @ui
    Scenario: Renaming the bookmark video
        Given there is a video bookmark titled "Star Wars"
        And I want to modify the "Star Wars" bookmark
        When I rename it to "Game Of Thrones"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And I should see the bookmark "Game Of Thrones" in the list
        But there should not be "Star Wars" bookmark anymore

    @ui
    Scenario: Renaming the bookmark photo
        Given there is a photo bookmark titled "Star Wars"
        And I want to modify the "Star Wars" bookmark
        When I rename it to "Game Of Thrones"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And I should see the bookmark "Game Of Thrones" in the list
        But there should not be "Star Wars" bookmark anymore
