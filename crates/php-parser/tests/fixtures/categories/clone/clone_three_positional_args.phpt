===config===
min_php=8.5
===source===
<?php clone($x, $y, $z);
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
                      "clone"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 14
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 18
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
