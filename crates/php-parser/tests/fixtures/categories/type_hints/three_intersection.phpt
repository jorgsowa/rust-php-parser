===source===
<?php function f(Countable&Traversable&ArrayAccess $x): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 51,
                  "end": 53
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 26
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Traversable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 38
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "ArrayAccess"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 39,
                            "end": 50
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 50
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 50
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 53
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 56,
                  "end": 60
                }
              }
            },
            "span": {
              "start": 56,
              "end": 60
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
