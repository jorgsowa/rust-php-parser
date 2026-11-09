===source===
<?php
(true)::class;
===errors <=7.4===
Cannot use "::class" on true
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on true
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on true in Standard input code on line 2
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
                      "Bool": true
                    },
                    "span": {
                      "start": 7,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 14,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
