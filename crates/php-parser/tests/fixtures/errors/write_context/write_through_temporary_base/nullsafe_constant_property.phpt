===source===
<?php
OBJ?->a = 1;
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
Can't use nullsafe operator in write context
===errors >=8.0===
Can't use nullsafe operator in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Can't use nullsafe operator in write context in Standard input code on line 2
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
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
