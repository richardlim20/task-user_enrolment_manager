<?php

namespace App;

/**
 * Manage enrolments of users in courses.
 */
class enrolment_manager
{
    /** @var array List of user objects. */
    private array $users = [];

    /** @var array List of course objects. */
    private array $courses = [];

    /** @var array List of enrolments. */
    private array $enrolments = [];

    /**
     * Populate valid users and courses in the object's memory to use for enrolments.
     *
     * @param array $users Array of user objects.
     * @param array $courses Array of course objects.
     */
    public function __construct(array $users, array $courses)
    {
        // We populate this class with user and course data instead of relying on a database to simplify the application.
        $this->users = $users;
        $this->courses = $courses;
    }

    /**
     * Enrol a user in a course.
     *
     * @param int $userid ID of user object.
     * @param int $courseid ID of course object.
     * @return void
     */
    public function enrol_user(int $userid, int $courseid): void
    {
        //Looping through array to check if user or course exists, breaking once found.
        $userExists = false;
        foreach ($this->users as $user) {
            if ($user->id === $userid) {
                $userExists = true;
                break;
            }
        }
        $courseExists = false;
        foreach ($this->courses as $course) {
            if ($course->id === $courseid) {
                $courseExists = true;
                break;
            }
        }
        //Throw error message if not found.
        if (!$userExists || !$courseExists) {
            throw new \InvalidArgumentException("Invalid user or course ID.");
        }

        // Check for duplicate enrolment and ends if duplicate
        foreach ($this->enrolments as $enrolment) {
            if ($enrolment['userid'] === $userid && $enrolment['courseid'] === $courseid) {
                return;
            }
        }

        //Adds enrolment
        $this->enrolments[] = [
            'userid' => $userid,
            'courseid' => $courseid
        ];
    }

    /**
     * Unenrol a user from a course.
     *
     * @param int $userid ID of user object.
     * @param int $courseid ID of user object.
     * @return void
     */
    public function unenrol_user(int $userid, int $courseid): void
    {
        // Implement this.
    }

    /**
     * Get all courses a user is enrolled in.
     *
     * @param int $userid ID of user object.
     * @return array
     */
    public function get_user_courses(int $userid): array
    {
        $userCourses = [];
        //Loops through each object of enrolment array
        foreach ($this->enrolments as $enrolment) {
            //Check if userid exists in enrolment
            if ($enrolment['userid'] === $userid) {
                foreach ($this->courses as $course) {
                    //Check if course id exists in enrolment and add course to $usercourses[]
                    if ($course->id === $enrolment['courseid']) {
                        $userCourses[] = $course;
                        break;
                    }
                }
            }
        }
        return $userCourses;
    }
}
