<?php 
// Interface segregation principle
    // Many client-specific interfaces are better than one general-purpose interface
    // A client should never be forced to implement an interface that it doesn't use, or clients shouldn't be forced to depend on methods they do not use


        // ISP Interface Segregation Principle a violation example
        interface Workable {
            public function work();
            public function canCode();
            public function test();
        }

        class Programmer implements Workable {
            public function canCode() {
                return $this->code();
            }

            public function code() {
                return "coding";
            }

            public function test() {
                return "testing";
            }
        }

        class Tester implements Workable {
            public function canCode() {
                return false;
            }

            public function code() {
                throw new Exception("I can't code");
            }

            public function test() {
                return "testing";
            }
        }
        
        class ProjectManagement {
            public function process(Workable $member) {
                if( $member->canCode() ) {
                    $member->code();
                }
            }
        }

        // ISP Interface Segregation Principle a solution example
        interface Codeable {
            public function code();
        }

        interface Testable {
            public function test();
        }

        class Programmer implements Codeable, Testable {
            public function code() {
                return "coding";
            }

            public function test() {
                return "testing";
            }
        }

        class Tester implements Testable {
            public function test() {
                return "testing";
            }
        }

        class ProjectManagement {
            public function process(Codeable $member) {
                $member->code();
            }
        }

?>