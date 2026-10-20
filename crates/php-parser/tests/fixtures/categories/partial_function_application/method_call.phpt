===source===
<?php $fn = $obj->method(?, 2);
===php_error <=8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 1
===ast >=8.6===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 18,
                        "end": 24
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "Placeholder",
                        "span": {
                          "start": 25,
                          "end": 26
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
                              "start": 28,
                              "end": 29
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
