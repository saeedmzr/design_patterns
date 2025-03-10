<?php

// Singleton pattern using inheritance
class SingletonWithInheritance {
    private static $instance = null;

    // Private constructor to prevent direct instantiation
    private function __construct() {}

    // Method to get the singleton instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    private function __wakeup() {}
}

class MyClass1 extends SingletonWithInheritance {
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}

// Singleton pattern by overriding __new__ directly (not applicable in PHP, so we use a similar approach)
class MyClass2 {
    private static $instance = null;
    private $value;

    // Private constructor to prevent direct instantiation
    private function __construct($value) {
        $this->value = $value;
    }

    // Method to get the singleton instance
    public static function getInstance($value) {
        if (self::$instance === null) {
            self::$instance = new self($value);
        }
        return self::$instance;
    }

    public function getValue() {
        return $this->value;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    private function __wakeup() {}
}

// Singleton pattern using a metaclass-like approach (not directly applicable in PHP, so we use a trait)
trait SingletonMeta {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    private function __wakeup() {}
}

class MyClass3 {
    use SingletonMeta;

    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}

// Singleton pattern using a decorator-like approach (not directly applicable in PHP, so we use a closure)
class MyClass4 {
    private static $instance = null;
    private $value;

    // Private constructor to prevent direct instantiation
    private function __construct($value) {
        $this->value = $value;
    }

    // Method to get the singleton instance
    public static function getInstance($value) {
        if (self::$instance === null) {
            self::$instance = new self($value);
        }
        return self::$instance;
    }

    public function getValue() {
        return $this->value;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    private function __wakeup() {}
}

?>