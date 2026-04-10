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
              "end": 15
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
                              "end": 25
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 38
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
