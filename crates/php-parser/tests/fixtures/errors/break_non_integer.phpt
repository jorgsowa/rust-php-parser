===source===
<?php
while (1) { break $a; }
===errors >=8.5===
'break' operator with non-integer operand is no longer supported
===php_error===
PHP Fatal error:  'break' operator with non-integer operand is no longer supported in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 24,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 29
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
