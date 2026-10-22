===source===
<?php func(a: 1, 2);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
cannot use positional argument after named argument
===errors >=8.0===
cannot use positional argument after named argument
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use positional argument after named argument in Standard input code on line 1
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
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
