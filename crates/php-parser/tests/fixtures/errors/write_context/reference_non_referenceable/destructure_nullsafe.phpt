===source===
<?php
[&$a] = $b?->c;
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.1===
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
