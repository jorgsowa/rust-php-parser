===source===
<?php func(...$args, last: 'end');
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named argument after argument unpacking' requires PHP 8.1 or higher
===errors 8.0===
'named argument after argument unpacking' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
===php_error 8.0===
PHP Fatal error:  Cannot combine named arguments and argument unpacking in Standard input code on line 1
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
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "args"
                      },
                      "span": {
                        "start": 14,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                {
                  "name": {
                    "parts": [
                      "last"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 25
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "end"
                      },
                      "span": {
                        "start": 27,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 32
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
