===source===
<?php
namespace X;
echo (\M_PI)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on float
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 3
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type float in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on float in Standard input code on line 3
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
                            "M_PI"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 25,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 31
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 33,
                    "end": 38
                  }
                }
              }
            },
            "span": {
              "start": 24,
              "end": 38
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
