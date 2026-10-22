===source===
<?php $x = &$a?->b;
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
===errors >=8.0===
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 18
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
