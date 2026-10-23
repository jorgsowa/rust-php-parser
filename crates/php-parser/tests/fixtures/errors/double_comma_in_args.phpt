===source===
<?php foo(1,, 2);
===errors===
expected expression, found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting ')' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ",", expecting ")" in Standard input code on line 1
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
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 11
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": "Error",
                      "span": {
                        "start": 12,
                        "end": 12
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 12
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
                        "start": 14,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 15
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
