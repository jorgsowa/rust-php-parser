===source===
<?php $a = [=> 'value'];
===errors===
expected expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW), expecting ']' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=>", expecting "]" in Standard input code on line 1
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": "Error",
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "String": "value"
                          },
                          "span": {
                            "start": 15,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
