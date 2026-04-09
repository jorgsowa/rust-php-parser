===source===
<?php
function page() {
    header();
    ?><header><?php
    nav();
    ?></header><?php
    body();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "page",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "header"
                        },
                        "span": {
                          "start": 28,
                          "end": 34,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 36,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 42,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "InlineHtml": "<header>"
              },
              "span": {
                "start": 44,
                "end": 52,
                "start_line": 4,
                "start_col": 6
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 62,
                "end": 65,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "nav"
                        },
                        "span": {
                          "start": 62,
                          "end": 65,
                          "start_line": 5,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 62,
                    "end": 67,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 73,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "InlineHtml": "</header>"
              },
              "span": {
                "start": 75,
                "end": 84,
                "start_line": 6,
                "start_col": 6
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 94,
                "end": 98,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "body"
                        },
                        "span": {
                          "start": 94,
                          "end": 98,
                          "start_line": 7,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 100,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 94,
                "end": 102,
                "start_line": 7,
                "start_col": 4
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
        "end": 103,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103,
    "start_line": 1,
    "start_col": 0
  }
}
