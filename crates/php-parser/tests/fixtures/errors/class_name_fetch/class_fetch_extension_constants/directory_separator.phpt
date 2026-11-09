===source===
<?php
(DIRECTORY_SEPARATOR)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on string
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type string in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on string in Standard input code on line 2
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
                          "DIRECTORY_SEPARATOR"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 26
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 27
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 29,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
