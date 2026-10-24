===source===
<?php $x = fn => 1; echo 1;
===errors===
expected '(', found '=>'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW), expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=>", expecting "(" in Standard input code on line 1
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
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 25,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
