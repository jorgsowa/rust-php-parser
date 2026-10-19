===source===
<?php function g() { yield from [1]; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 33,
                                    "end": 34
                                  }
                                }
                              },
                              "span": {
                                "start": 33,
                                "end": 34
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 32,
                          "end": 35
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 36
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
