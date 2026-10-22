===description===
PHP: `10 ** $obj?->prop` is `10 ** ($obj?->prop)`. Nullsafe access binds tighter than `**`.
===source===
<?php
10 ** $obj?->prop;
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
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
