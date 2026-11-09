===source===
<?php
([])::class;
===errors <=7.4===
Cannot use "::class" on array
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on array
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type array in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on array in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
