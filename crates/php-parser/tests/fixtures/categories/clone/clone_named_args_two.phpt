===config===
min_php=8.5
===source===
<?php clone(object: $x, withProperties: ['foo' => 1]);
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
                  "Identifier": "clone"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": "object",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 20,
                      "end": 22
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 12,
                    "end": 22
                  }
                },
                {
                  "name": "withProperties",
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "foo"
                            },
                            "span": {
                              "start": 41,
                              "end": 46
                            }
                          },
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 50,
                              "end": 51
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 41,
                            "end": 51
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 40,
                      "end": 52
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 24,
                    "end": 52
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
