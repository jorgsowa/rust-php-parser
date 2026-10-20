===source===
<?php $x = "{$obj::CONST}";
===errors >=8.4===
class constant access is not valid as a standalone interpolation expression
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "}", expecting "->" or "?->" or "{" or "[" in Standard input code on line 1
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "}", expecting "->" or "?->" or "[" in Standard input code on line 1
===ast >=8.4===
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
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 13,
                                "end": 17
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "CONST"
                              },
                              "span": {
                                "start": 19,
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
