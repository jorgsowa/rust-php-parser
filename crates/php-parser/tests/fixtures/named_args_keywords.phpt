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
                  "end": 17
                }
              },
              "args": [
                {
                  "name": {
                    "name": "array",
                    "span": {
                      "start": 18,
                      "end": 23
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 25,
                      "end": 29
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 18,
                    "end": 29
                  }
                },
                {
                  "name": {
                    "name": "offset",
                    "span": {
                      "start": 31,
                      "end": 37
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 31,
                    "end": 40
                  }
                },
                {
                  "name": {
                    "name": "length",
                    "span": {
                      "start": 42,
                      "end": 48
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 42,
                    "end": 51
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 52
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53
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
                  "end": 57
                }
              },
              "args": [
                {
                  "name": {
                    "name": "class",
                    "span": {
                      "start": 58,
                      "end": 63
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "MyClass"
                    },
                    "span": {
                      "start": 65,
                      "end": 74
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 58,
                    "end": 74
                  }
                },
                {
                  "name": {
                    "name": "static",
                    "span": {
                      "start": 76,
                      "end": 82
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 84,
                      "end": 88
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 76,
                    "end": 88
                  }
                },
                {
                  "name": {
                    "name": "match",
                    "span": {
                      "start": 90,
                      "end": 95
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "yes"
                    },
                    "span": {
                      "start": 97,
                      "end": 102
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 90,
                    "end": 102
                  }
                }
              ]
            }
          },
          "span": {
            "start": 54,
            "end": 103
          }
        }
      },
      "span": {
        "start": 54,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}
