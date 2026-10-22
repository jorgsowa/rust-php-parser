===source===
<?php $x = "{$obj::{$name}}";
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
class constant access is not valid as a standalone interpolation expression
===errors >=8.3===
class constant access is not valid as a standalone interpolation expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting '(' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "}", expecting "(" in Standard input code on line 1
===php_error 8.3===
PHP Parse error:  syntax error, unexpected token "}", expecting "->" or "?->" or "{" or "[" in Standard input code on line 1
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "}", expecting "->" or "?->" or "[" in Standard input code on line 1
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
