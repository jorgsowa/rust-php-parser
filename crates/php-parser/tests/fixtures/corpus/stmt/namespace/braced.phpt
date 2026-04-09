===source===
<?php

namespace Foo\Bar {
    foo;
}
namespace {
    bar;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo",
              "Bar"
            ],
            "kind": "Qualified",
            "span": {
              "start": 17,
              "end": 25,
              "start_line": 3,
              "start_col": 10
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 31,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 36,
                  "start_line": 4,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 37,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Identifier": "bar"
                    },
                    "span": {
                      "start": 54,
                      "end": 57,
                      "start_line": 7,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 54,
                  "end": 59,
                  "start_line": 7,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 38,
        "end": 60,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
