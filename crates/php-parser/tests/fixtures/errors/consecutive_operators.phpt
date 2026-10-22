===source===
<?php $x = + + ;
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
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
                  "UnaryPrefix": {
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "Plus",
                          "operand": {
                            "kind": "Error",
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
