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
                  "Name": {
                    "parts": [
                      "array_slice"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 18,
                      "end": 23
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 25,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 29
                  }
                },
                {
                  "name": {
                    "parts": [
                      "offset"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 31,
                      "end": 37
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 39,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 31,
                    "end": 40
                  }
                },
                {
                  "name": {
                    "parts": [
                      "length"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 42,
                      "end": 48
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 50,
                        "end": 51
                      }
                    }
                  },
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
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 54,
                      "end": 57
                    }
                  }
                },
                "span": {
                  "start": 54,
                  "end": 57
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "class"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 58,
                      "end": 63
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "MyClass"
                      },
                      "span": {
                        "start": 65,
                        "end": 74
                      }
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 74
                  }
                },
                {
                  "name": {
                    "parts": [
                      "static"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 76,
                      "end": 82
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 84,
                        "end": 88
                      }
                    }
                  },
                  "span": {
                    "start": 76,
                    "end": 88
                  }
                },
                {
                  "name": {
                    "parts": [
                      "match"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 90,
                      "end": 95
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "yes"
                      },
                      "span": {
                        "start": 97,
                        "end": 102
                      }
                    }
                  },
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
