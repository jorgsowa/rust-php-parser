===source===
<?php
foo(a: $b, c: $d);
bar(class: 0);
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 13,
                      "end": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 15
                  }
                },
                {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "d"
                    },
                    "span": {
                      "start": 20,
                      "end": 22
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 17,
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              },
              "args": [
                {
                  "name": {
                    "name": "class",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 37
                  }
                }
              ]
            }
          },
          "span": {
            "start": 25,
            "end": 38
          }
        }
      },
      "span": {
        "start": 25,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
