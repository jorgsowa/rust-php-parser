===source===
<?php foo(...$extra, name: 'test');
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
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "extra"
                      },
                      "span": {
                        "start": 13,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 19
                  }
                },
                {
                  "name": {
                    "parts": [
                      "name"
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
                        "String": "test"
                      },
                      "span": {
                        "start": 27,
                        "end": 33
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 33
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
