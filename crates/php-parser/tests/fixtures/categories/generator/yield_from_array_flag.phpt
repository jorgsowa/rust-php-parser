===source===
<?php function g() { yield from [1]; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "g",
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
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 33,
                                  "end": 34
                                }
                              },
                              "unpack": false,
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
                "end": 37
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
