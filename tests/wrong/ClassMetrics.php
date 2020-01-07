<?php

namespace Test;

class ClassMetrics {
    public function foo($a, $b, $c, $d, $e, $f)
    {
        if ($a) {
            if ($b) {
                if ($c) {
                    if ($d) {
                        if ($e) {
                            return $f;
                        }
                    }
                }
            }
        }

        if (true) {
          return true;
        } else {
             return false;
        }
    }
}
