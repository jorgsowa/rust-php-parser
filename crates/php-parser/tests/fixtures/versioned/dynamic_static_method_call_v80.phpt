===config===
min_php=8.0
max_php=8.0
===source===
<?php
A::{$m}();
A::{"b" . $c}(1);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "method": {
                "kind": {
                  "Variable": "m"
                },
                "span": {
                  "start": 10,
                  "end": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 27,
                        "end": 29
                      }
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 29
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
                      "start": 31,
                      "end": 32
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 31,
                    "end": 32
                  }
                }
              ]
            }
          },
          "span": {
            "start": 17,
            "end": 33
          }
        }
      },
      "span": {
        "start": 17,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
