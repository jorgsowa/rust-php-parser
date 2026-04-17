===source===
<?php $f = fn() => fn() => fn() => 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [],
                                "return_type": null,
                                "body": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 35,
                                    "end": 36
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 27,
                              "end": 36
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 36
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
