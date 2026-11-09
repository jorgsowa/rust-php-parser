===source===
<?php match($x) { 1 => 'a' 2 => 'b' }
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
expected '}', found integer
expected ';' after expression
===errors >=8.0===
expected '}', found integer
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "2", expecting "}" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 26
                  }
                },
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 32,
                      "end": 35
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 35
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
