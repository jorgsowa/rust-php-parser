===source===
<?php while ($x): doStuff(); endwhile;
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 13,
              "end": 15,
              "start_line": 1,
              "start_col": 13
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "doStuff"
                            },
                            "span": {
                              "start": 18,
                              "end": 25,
                              "start_line": 1,
                              "start_col": 18
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 29,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 38,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
