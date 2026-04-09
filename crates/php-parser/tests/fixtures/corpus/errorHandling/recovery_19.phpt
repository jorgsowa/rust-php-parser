===source===
<?php

foo(Bar::);
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 7,
                  "end": 10,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Identifier": "Bar"
                          },
                          "span": {
                            "start": 11,
                            "end": 14,
                            "start_line": 3,
                            "start_col": 4
                          }
                        },
                        "member": "<error>"
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 16,
                      "start_line": 3,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 16,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 17,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 18,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
