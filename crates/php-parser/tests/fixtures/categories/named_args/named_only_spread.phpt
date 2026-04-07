===source===
<?php foo(...['name' => $x]);
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
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "name"
                            },
                            "span": {
                              "start": 14,
                              "end": 20
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 24,
                              "end": 26
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 14,
                            "end": 26
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 13,
                      "end": 27
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 27
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
