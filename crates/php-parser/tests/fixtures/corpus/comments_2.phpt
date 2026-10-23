===source===
<?php

/** doc */
/* foobar */
// foo
// bar

?>
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 46,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
