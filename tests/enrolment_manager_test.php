<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\user;
use App\course;
use App\enrolment_manager;

/**
 * Test the enrolment_manager class.
 */
class enrolment_manager_test extends TestCase
{

    /** @var enrolment_manager Instance of enrolment_manager. */
    private enrolment_manager $manager;

    /**
     * Set up the test data and instantiate the manager.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $users = [
            new user(1, "Alice"),
            new user(2, "Bob")
        ];
        $courses = [
            new course(100, "Intro to PHP"),
            new course(200, "Moodle Basics")
        ];
        $this->manager = new enrolment_manager($users, $courses);
    }

    /**
     * Test a user can be enrolled.
     */
    public function test_enrol_user_successfully(): void
    {
        $this->manager->enrol_user(1, 100);
        $courses = $this->manager->get_user_courses(1);
        $this->assertCount(1, $courses);
    }

    // Add more tests: duplicate enrol, invalid ID, unenrol, etc.

    /**
     * Test duplicate enroll
     */
    public function testDuplicateEnrol(): void
    {
        $this->manager->enrol_user(1, 100);
        $this->manager->enrol_user(1, 100);
        $courses = $this->manager->get_user_courses(1);
        //should still only show 1 course
        $this->assertCount(1, $courses);
    }

    /**
     * Test invalid ID
     */

    //Invalid UserID
    public function testInvalidUserIdThrowsException(): void
    {
        $this->expectExceptionMessage('Invalid user or course ID.');
        $this->manager->enrol_user(999, 100);
    }

    //Invalid CourseID
    public function testInvalidCourseIdThrowsException(): void
    {
        $this->expectExceptionMessage('Invalid user or course ID.');
        $this->manager->enrol_user(1, 999);
    }
    //Invalid UserID and CourseID
    public function testInvalidUserCourseIdThrowsException(): void
    {
        $this->expectExceptionMessage('Invalid user or course ID.');
        $this->manager->enrol_user(999, 999);
    }

    /**
     * Test user unenroll
     */
    public function testUserUnenrol(): void
    {
        $this->manager->enrol_user(1, 100);
        $this->manager->unenrol_user(1, 100);
        $courses = $this->manager->get_user_courses(1);
        //Should be 0 courses
        $this->assertCount(0, $courses);
    }
}
