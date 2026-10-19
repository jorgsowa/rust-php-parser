===source===
<?php foo(1, 'bar', name: $val, count: 5);
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
                      "kind": {
                        "String": "bar"
                      },
                      "span": {
                        "start": 13,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 18
                  }
                },
                {
                  "name": {
                    "parts": [
                      "name"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "val"
                      },
                      "span": {
                        "start": 26,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 30
                  }
                },
                {
                  "name": {
                    "parts": [
                      "count"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 32,
                      "end": 37
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 39,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 40
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 41
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
