===source===
<?php
foo(...);
$this->foo(...);
A::foo(...);

// These are invalid, but accepted on the parser level.
new Foo(...);
$this?->foo(...);

#[Foo(...)]
function foo() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Function": {
                  "kind": {
                    "Identifier": "foo"
                  },
                  "span": {
                    "start": 6,
                    "end": 9,
                    "start_line": 2,
                    "start_col": 0
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 16,
                      "end": 21,
                      "start_line": 3,
                      "start_col": 0
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 23,
                      "end": 26,
                      "start_line": 3,
                      "start_col": 7
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 31,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 33,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "StaticMethod": {
                  "class": {
                    "kind": {
                      "Identifier": "A"
                    },
                    "span": {
                      "start": 33,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 0
                    }
                  },
                  "method": "foo"
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 44,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 103,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 107,
                  "end": 110,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 103,
            "end": 115,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 103,
        "end": 117,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "NullsafeMethod": {
                  "object": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 117,
                      "end": 122,
                      "start_line": 8,
                      "start_col": 0
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 125,
                      "end": 128,
                      "start_line": 8,
                      "start_col": 8
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 117,
            "end": 133,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 117,
        "end": 136,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Foo"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 138,
                  "end": 141,
                  "start_line": 10,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 138,
                "end": 146,
                "start_line": 10,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 148,
        "end": 165,
        "start_line": 11,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165,
    "start_line": 1,
    "start_col": 0
  }
}
