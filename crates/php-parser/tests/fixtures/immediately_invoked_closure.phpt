===source===
<?php (function() { echo 'hi'; })();
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
                  "Parenthesized": {
                    "kind": {
                      "Closure": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [],
                        "return_type": null,
                        "body": [
                          {
                            "kind": {
                              "Echo": [
                                {
                                  "kind": {
                                    "String": "hi"
                                  },
                                  "span": {
                                    "start": 25,
                                    "end": 29,
                                    "start_line": 1,
                                    "start_col": 25
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 20,
                              "end": 31,
                              "start_line": 1,
                              "start_col": 20
                            }
                          }
                        ],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 32,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 35,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
