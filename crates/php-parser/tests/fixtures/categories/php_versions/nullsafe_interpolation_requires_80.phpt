===source===
<?php
$x = "{$obj?->prop}";
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 13,
                                "end": 17
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "prop"
                              },
                              "span": {
                                "start": 20,
                                "end": 24
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 24
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
