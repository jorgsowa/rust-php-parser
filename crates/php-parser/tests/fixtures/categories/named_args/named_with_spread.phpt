===source===
<?php foo(...$extra, name: 'test');
===php_error <=8.0===
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
