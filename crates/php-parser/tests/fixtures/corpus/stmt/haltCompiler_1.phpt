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
            "end": 9,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 11,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "HaltCompiler": "\nHallo World!"
      },
      "span": {
        "start": 11,
        "end": 44,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
