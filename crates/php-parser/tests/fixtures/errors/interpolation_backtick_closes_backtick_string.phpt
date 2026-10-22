===source===
<?php
$x = `{$a[`]}`;
===errors===
unterminated string literal
unclosed '{' in string interpolation
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting ']' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "]" in Standard input code on line 2
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
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 13,
                                "end": 15
                              }
                            },
                            "index": {
                              "kind": {
                                "ShellExec": [
                                  {
                                    "Literal": "]}"
                                  }
                                ]
                              },
                              "span": {
                                "start": 16,
                                "end": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 20
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
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
