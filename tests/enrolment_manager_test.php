<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\user;
use App\course;
use App\enrolment_manager;

/**
 * Test the enrolment_manager class.
 */
class enrolment_manager_test extends TestCase {

    /** @var enrolment_manager Instance of enrolment_manager. */
    private enrolment_manager $manager;

    /**
     * Set up the test data and instantiate the manager.
     *
     * @return void
     */
    protected function setUp(): void {
        $users = [
            1 => new user(1, "Alice"),
            2 => new user(2, "Bob")
        ];
        $courses = [
            100 => new course(100, "Intro to PHP"),
            200 => new course(200, "Moodle Basics")
        ];
        $this->manager = new enrolment_manager($users, $courses);
    }

    /**
     * Test a user can be enrolled.
     */
    public function test_enrol_user_successfully(): void {
        $this->manager->enrol_user(1, 100);
        $courses = $this->manager->get_user_courses(1);
        $this->assertCount(1, $courses);
    }

    // Add more tests: duplicate enrol, invalid ID, unenrol, etc.
}
