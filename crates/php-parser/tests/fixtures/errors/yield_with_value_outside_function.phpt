===source===
<?php yield $x;
===errors===
'yield' can only be used inside a function
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Yield": {
              "key": null,
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "is_from": false
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
===php_error===
PHP Fatal error:  The "yield" expression can only be used inside a function in Standard input code on line 1
