===source===
<?php
const A = (B)::C;
===errors===
Dynamic class names are not allowed in compile-time class constant references
===php_error===
PHP Fatal error:  Dynamic class names are not allowed in compile-time class constant references in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 18
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "C"
                    },
                    "span": {
                      "start": 21,
                      "end": 22
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 22
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
