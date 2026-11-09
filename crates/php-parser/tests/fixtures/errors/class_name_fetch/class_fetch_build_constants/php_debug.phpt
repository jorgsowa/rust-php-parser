===source===
<?php
(PHP_DEBUG)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors 8.0-8.3===
Cannot use "::class" on int
===errors >=8.4===
Cannot use "::class" on bool
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "::class" on false in Standard input code on line 2
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
                          "PHP_DEBUG"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 16
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 19,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
