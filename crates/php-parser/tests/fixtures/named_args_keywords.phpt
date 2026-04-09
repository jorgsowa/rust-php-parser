===source===
<?php
array_slice(array: $arr, offset: 1, length: 2);
foo(class: 'MyClass', static: true, match: 'yes');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "array_slice"
                },
                "span": {
                  "start": 6,
                  "end": 17,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "array",
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 25,
                      "end": 29,
                      "start_line": 2,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 18,
                    "end": 29,
                    "start_line": 2,
                    "start_col": 12
                  }
                },
                {
                  "name": "offset",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40,
                      "start_line": 2,
                      "start_col": 33
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 31,
                    "end": 40,
                    "start_line": 2,
                    "start_col": 25
                  }
                },
                {
                  "name": "length",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 50,
                      "end": 51,
                      "start_line": 2,
                      "start_col": 44
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 42,
                    "end": 51,
                    "start_line": 2,
                    "start_col": 36
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 52,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 54,
                  "end": 57,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "class",
                  "value": {
                    "kind": {
                      "String": "MyClass"
                    },
                    "span": {
                      "start": 65,
                      "end": 74,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 58,
                    "end": 74,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                {
                  "name": "static",
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 84,
                      "end": 88,
                      "start_line": 3,
                      "start_col": 30
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 76,
                    "end": 88,
                    "start_line": 3,
                    "start_col": 22
                  }
                },
                {
                  "name": "match",
                  "value": {
                    "kind": {
                      "String": "yes"
                    },
                    "span": {
                      "start": 97,
                      "end": 102,
                      "start_line": 3,
                      "start_col": 43
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 90,
                    "end": 102,
                    "start_line": 3,
                    "start_col": 36
                  }
                }
              ]
            }
          },
          "span": {
            "start": 54,
            "end": 103,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 54,
        "end": 104,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104,
    "start_line": 1,
    "start_col": 0
  }
}
