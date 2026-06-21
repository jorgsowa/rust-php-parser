===config===
min_php=8.0
===description===
PHP: `10 ** $obj?->prop` is `10 ** ($obj?->prop)`. Nullsafe access binds tighter than `**`.
===source===
<?php
10 ** $obj?->prop;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 19,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
