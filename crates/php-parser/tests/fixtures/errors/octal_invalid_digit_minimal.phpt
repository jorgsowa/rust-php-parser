===source===
<?php 08; 09;
===errors===
Invalid numeric literal
Invalid numeric literal
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 6,
            "end": 8
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 10,
            "end": 12
          }
        }
      },
      "span": {
        "start": 10,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
===php_error===
PHP Parse error:  Invalid numeric literal in Standard input code on line 1
