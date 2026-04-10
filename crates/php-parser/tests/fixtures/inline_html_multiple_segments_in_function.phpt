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
                          "end": 34
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 37
              }
            },
            {
              "kind": {
                "InlineHtml": "<header>"
              },
              "span": {
                "start": 44,
                "end": 52
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 62,
                "end": 65
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
                          "end": 65
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 62,
                    "end": 67
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 68
              }
            },
            {
              "kind": {
                "InlineHtml": "</header>"
              },
              "span": {
                "start": 75,
                "end": 84
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 94,
                "end": 98
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
                          "end": 98
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 100
                  }
                }
              },
              "span": {
                "start": 94,
                "end": 101
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
        "end": 103
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103
  }
}
