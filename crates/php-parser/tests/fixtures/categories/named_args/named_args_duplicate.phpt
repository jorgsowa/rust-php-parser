===source===
<?php func(a: 1, a: 2);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "func"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 10
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 11,
                      "end": 12
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 21
                  }
                }
              ]
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
