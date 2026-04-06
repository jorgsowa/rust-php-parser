<?php
trait T1 { public function m() {} }
trait T2 { public function m() {} }
trait T3 { public function m() {} }
class C {
    use T1, T2, T3 {
        T1::m insteadof T2, T3;
        T2::m insteadof T3;
    }
}
