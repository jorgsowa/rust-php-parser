===source===
<?php
namespace X;
echo (\PHP_INT_MAX)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 3
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "X"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "PHP_INT_MAX"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 25,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 38
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 40,
                    "end": 45
                  }
                }
              }
            },
            "span": {
              "start": 24,
              "end": 45
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
