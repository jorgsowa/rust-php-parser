===source===
<?php
(MT_RAND_PHP)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors 8.0-8.2===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
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
                      "Name": {
                        "parts": [
                          "MT_RAND_PHP"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 18
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 21,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
