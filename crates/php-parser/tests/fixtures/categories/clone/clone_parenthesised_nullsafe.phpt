===source===
<?php
clone($a)?->b;
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
            "Clone": {
              "kind": {
                "NullsafePropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 15
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 18,
                      "end": 19
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 19
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
