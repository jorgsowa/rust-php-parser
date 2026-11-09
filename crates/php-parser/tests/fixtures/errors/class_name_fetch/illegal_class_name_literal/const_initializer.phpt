===source===
<?php
const A = (1)::BAR;
===errors===
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
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
                          "Int": 1
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
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 21,
                      "end": 24
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 24
            }
          }
        ]
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
