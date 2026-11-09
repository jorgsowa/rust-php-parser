===source===
<?php
(PCRE_VERSION_MAJOR)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
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
                          "PCRE_VERSION_MAJOR"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 25
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 26
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 28,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
