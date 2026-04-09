===source===
<?php $obj?->address?->city; $obj?->getAddress()?->getCity();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 6,
                        "end": 10,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "address"
                      },
                      "span": {
                        "start": 13,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "property": {
                "kind": {
                  "Identifier": "city"
                },
                "span": {
                  "start": 23,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "NullsafeMethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 29,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 29
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "getAddress"
                      },
                      "span": {
                        "start": 36,
                        "end": 46,
                        "start_line": 1,
                        "start_col": 36
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 29,
                  "end": 48,
                  "start_line": 1,
                  "start_col": 29
                }
              },
              "method": {
                "kind": {
                  "Identifier": "getCity"
                },
                "span": {
                  "start": 51,
                  "end": 58,
                  "start_line": 1,
                  "start_col": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 29,
            "end": 60,
            "start_line": 1,
            "start_col": 29
          }
        }
      },
      "span": {
        "start": 29,
        "end": 61,
        "start_line": 1,
        "start_col": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61,
    "start_line": 1,
    "start_col": 0
  }
}
