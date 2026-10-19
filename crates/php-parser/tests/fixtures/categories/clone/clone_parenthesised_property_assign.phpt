===source===
<?php
clone($a)->b = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 12,
                                "end": 14
                              }
                            }
                          },
                          "span": {
                            "start": 11,
                            "end": 15
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 17,
                            "end": 18
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 18
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 21,
                      "end": 22
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 22
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
