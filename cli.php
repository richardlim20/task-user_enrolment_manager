<?php


require_once __DIR__ . '/src/user.php';
require_once __DIR__ . '/src/course.php';
require_once __DIR__ . '/src/enrolment_manager.php';
use App\user;
use App\course;
use App\enrolment_manager;

$users = [
    new user(1, "Alice"),
    new user(2, "Bob")
];
$courses = [
    new course(100, "Intro to PHP"),
    new course(200, "Moodle Basics")
];
$manager = new enrolment_manager($users, $courses);

$command = $argv[1];
$userid = (int)$argv[2];
$courseid = (int)$argv[3];

//sample enrolment
$manager->enrol_user(1, 100);


/**
 * CLI input: php <filepath/cli.php> , <command> <userid> <courseid>
 * e.g. php cli.php unenrol 1 100
 */

try {
    //checks for command and amount of args being 4
    if ($command === 'enrol' && $argc === 4) {
        $manager->enrol_user($userid, $courseid);
        echo "User $userid enrolled in course $courseid.\n";
        exit(0);
    } elseif ($command === 'unenrol' && $argc === 4) {
        $manager->unenrol_user($userid, $courseid);
        echo "User $userid unenrolled from course $courseid.\n";
        exit(0);
    } else {
        echo "Invalid command or arguments.\n";
        exit(1);
    }
    //returns error message
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
