===source===
<?php
const D = static::BAR;
===errors===
"static::" is not allowed in compile-time constants
===php_error===
PHP Fatal error:  "static::" is not allowed in compile-time constants in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
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
                      "Name": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 22
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
