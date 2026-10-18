===source===
<?php function gen() { yield from otherGen(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "gen",
            "span": {
              "start": 15,
              "end": 18
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
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "otherGen"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 34,
                                    "end": 42
                                  }
                                }
                              },
                              "span": {
                                "start": 34,
                                "end": 42
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 44
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 45
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
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
