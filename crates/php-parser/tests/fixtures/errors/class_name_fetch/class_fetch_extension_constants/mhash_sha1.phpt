===source===
<?php
(MHASH_SHA1)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors 8.0-8.4===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error 8.3-8.4===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
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
                          "MHASH_SHA1"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 20,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
