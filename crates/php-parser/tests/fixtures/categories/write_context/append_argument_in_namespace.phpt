===source===
<?php
namespace A;
function test($v) {}
test($arr[]);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 28,
              "end": 32
            }
          },
          "params": [
            {
              "name": {
                "name": "v",
                "span": {
                  "start": 33,
                  "end": 35
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 33,
                "end": 35
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 39
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "test"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 44
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 45,
                              "end": 49
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 51
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 51
                  }
                }
              ]
            }
          },
          "span": {
            "start": 40,
            "end": 52
          }
        }
      },
      "span": {
        "start": 40,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
