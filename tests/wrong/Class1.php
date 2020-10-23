<?php


namespace Test;

use Something\Foo;

use Something\bar;

abstract final class Test {

	private $unused_field;

    const TEST = 'NOTOK';

    use MyTrait, MyTrait2;

    public function __construct()
    {
        echo `test`;

        phpinfo2();

        print_r([
            1
          ]);

        $this->test = new class() {
        };
    }

    private function unused() {
        $fooBar = 1;
    	$foo_bar = '1';;

    	IF($foo_bar == '1') {
    		return true;
    		return true;
    	}

    	$this->foo(
    	    'a',
            2
        );
    }

    /**
     * @deprecated
     */
    private static function Foo(string $a, $b, $c) : array
    {
        return [$a, $b];
    }
}