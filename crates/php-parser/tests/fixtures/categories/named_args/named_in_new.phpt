===source===
<?php new Foo(x: 1, y: 2);
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
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "x"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 18
                  }
                },
                {
                  "name": {
                    "parts": [
                      "y"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
