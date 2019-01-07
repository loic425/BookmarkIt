@managing_bookmarks
Feature: Bookmarks validation
    In order to avoid making mistakes when managing bookmarks
    As an Visitor
    I want to be prevented from adding it without specifying required fields

    @ui
    Scenario: Trying to add a new video bookmark without title
        Given I want to create a new video bookmark
        When I do not specify its title
        And I try to add it
        Then I should be notified that the title is required
        And this bookmark should not be added

    @ui
    Scenario: Trying to add a new video bookmark without duration
        Given I want to create a new video bookmark
        When I do not specify its duration
        And I try to add it
        Then I should be notified that the duration is required
        And this bookmark should not be added

    @ui
    Scenario: Trying to remove duration on an existing video bookmark
        Given there is a video bookmark titled "Star Wars"
        Given I want to modify the "Star Wars" bookmark
        When I do not specify its duration
        And I try to save my changes
        Then I should be notified that the duration is required
