<?php
try {
    risky();
} catch (A|B|C $e) {
    handle($e);
}
