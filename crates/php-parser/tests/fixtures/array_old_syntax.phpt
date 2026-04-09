===source===
<?php array(1, 2, 3); array('a' => 1, 'b' => 2);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 12,
                    "end": 13,
                    "start_line": 1,
                    "start_col": 12
                  }
                },
                "unpack": false,
                "span": {
                  "start": 12,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 15,
                    "end": 16,
                    "start_line": 1,
                    "start_col": 15
                  }
                },
                "unpack": false,
                "span": {
                  "start": 15,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 15
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 3
                  },
                  "span": {
                    "start": 18,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 18
                  }
                },
                "unpack": false,
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 18
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 28,
                    "end": 31,
                    "start_line": 1,
                    "start_col": 28
                  }
                },
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 35,
                    "end": 36,
                    "start_line": 1,
                    "start_col": 35
                  }
                },
                "unpack": false,
                "span": {
                  "start": 28,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 28
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 38,
                    "end": 41,
                    "start_line": 1,
                    "start_col": 38
                  }
                },
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 45,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 45
                  }
                },
                "unpack": false,
                "span": {
                  "start": 38,
                  "end": 46,
                  "start_line": 1,
                  "start_col": 38
                }
              }
            ]
          },
          "span": {
            "start": 22,
            "end": 47,
            "start_line": 1,
            "start_col": 22
          }
        }
      },
      "span": {
        "start": 22,
        "end": 48,
        "start_line": 1,
        "start_col": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
