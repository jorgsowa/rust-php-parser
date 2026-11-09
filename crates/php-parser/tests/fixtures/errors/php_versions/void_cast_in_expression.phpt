===source===
<?php $x = (void)1 + 2;
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
(void) cast cannot be used in an expression context
===errors >=8.5===
(void) cast cannot be used in an expression context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected integer "1" in Standard input code on line 1
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 1
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
                  "Cast": [
                    "Void",
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
