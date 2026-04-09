===source===
<?php function gen() { yield from otherGen(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "otherGen"
                              },
                              "span": {
                                "start": 34,
                                "end": 42,
                                "start_line": 1,
                                "start_col": 34
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 44,
                          "start_line": 1,
                          "start_col": 34
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 44,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 46,
                "start_line": 1,
                "start_col": 23
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
