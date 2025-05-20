<?php
namespace App;

class enrolment_manager {
    private array $users = [];
    private array $courses = [];
    private array $enrolments = [];

    public function __construct(array $users, array $courses) {
        // We populate this class with user and course data instead of relying on a database to simplify the application.
        $this->users = $users;
        $this->courses = $courses;
    }

    public function enrol_user(int $userid, int $courseid): void {
        // Implement this
    }

    public function unenrol_user(int $userid, int $courseid): void {
        // Implement this
    }

    public function get_user_courses(int $userid): array {
        // Implement this
        return [];
    }
}
