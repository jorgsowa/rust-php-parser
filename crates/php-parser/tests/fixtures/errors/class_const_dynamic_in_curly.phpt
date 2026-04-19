===config===
min_php=8.4
===source===
<?php $x = "{$obj::{$name}}";
===errors===
class constant access is not valid as a standalone interpolation expression
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
                          "ClassConstAccessDynamic": {
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
                                "Variable": "name"
                              },
                              "span": {
                                "start": 20,
                                "end": 25
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 26
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "}", expecting "->" or "?->" or "[" in Standard input code on line 1
