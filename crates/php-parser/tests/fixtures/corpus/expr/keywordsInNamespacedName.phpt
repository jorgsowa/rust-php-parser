===source===
<?php
namespace fn;
namespace fn\use;
namespace self;
namespace parent;
namespace static;
fn\use();
\fn\use();
namespace\fn\use();
private\protected\public\static\abstract\final();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn",
              "use"
            ],
            "kind": "Qualified",
            "span": {
              "start": 30,
              "end": 36,
              "start_line": 3,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 20,
        "end": 38,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "self"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 48,
              "end": 52,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 38,
        "end": 54,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "parent"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 64,
              "end": 70,
              "start_line": 5,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 54,
        "end": 72,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "static"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 82,
              "end": 88,
              "start_line": 6,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 72,
        "end": 90,
        "start_line": 6,
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
                  "Identifier": "fn\\use"
                },
                "span": {
                  "start": 90,
                  "end": 96,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 90,
            "end": 98,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 90,
        "end": 100,
        "start_line": 7,
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
                  "Identifier": "\\fn\\use"
                },
                "span": {
                  "start": 100,
                  "end": 107,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 100,
            "end": 109,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 100,
        "end": 111,
        "start_line": 8,
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
                  "Identifier": "namespace\\fn\\use"
                },
                "span": {
                  "start": 111,
                  "end": 127,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 111,
            "end": 129,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 111,
        "end": 131,
        "start_line": 9,
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
                  "Identifier": "private\\protected\\public\\static\\abstract\\final"
                },
                "span": {
                  "start": 131,
                  "end": 177,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 131,
            "end": 179,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 131,
        "end": 180,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180,
    "start_line": 1,
    "start_col": 0
  }
}
