===source===
<?php
f(...$a, x: 1, 2);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named argument after argument unpacking' requires PHP 8.1 or higher
Cannot use positional argument after argument unpacking
===errors 8.0===
'named argument after argument unpacking' requires PHP 8.1 or higher
Cannot use positional argument after argument unpacking
===errors >=8.1===
Cannot use positional argument after argument unpacking
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 2
===php_error 8.0===
PHP Fatal error:  Cannot combine named arguments and argument unpacking in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use positional argument after argument unpacking in Standard input code on line 2
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
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 13
                  }
                },
                {
                  "name": {
                    "parts": [
                      "x"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 15,
                      "end": 16
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 19
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
                        "start": 21,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                }
              ]
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
