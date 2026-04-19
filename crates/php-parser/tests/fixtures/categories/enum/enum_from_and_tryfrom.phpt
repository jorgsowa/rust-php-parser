===source===
<?php Status::from(1); Status::tryFrom(99);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Status"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "method": {
                "kind": {
                  "Identifier": "from"
                },
                "span": {
                  "start": 14,
                  "end": 18
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 19,
                      "end": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Status"
                },
                "span": {
                  "start": 23,
                  "end": 29
                }
              },
              "method": {
                "kind": {
                  "Identifier": "tryFrom"
                },
                "span": {
                  "start": 31,
                  "end": 38
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 99
                    },
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 39,
                    "end": 41
                  }
                }
              ]
            }
          },
          "span": {
            "start": 23,
            "end": 42
          }
        }
      },
      "span": {
        "start": 23,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
