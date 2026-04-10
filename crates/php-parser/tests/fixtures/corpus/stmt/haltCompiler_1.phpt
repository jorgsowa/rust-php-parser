===source===
<?php

$a;
__halt_compiler()
?>
Hallo World!
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 7,
            "end": 9
          }
        }
      },
      "span": {
        "start": 7,
        "end": 10
      }
    },
    {
      "kind": {
        "HaltCompiler": "\nHallo World!"
      },
      "span": {
        "start": 11,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
