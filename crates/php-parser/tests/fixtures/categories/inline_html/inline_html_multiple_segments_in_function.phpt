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
          "name": {
            "name": "page",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "header"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 28,
                              "end": 34
                            }
                          }
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
              "kind": "Nop",
              "span": {
                "start": 42,
                "end": 44
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
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "nav"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 62,
                              "end": 65
                            }
                          }
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
              "kind": "Nop",
              "span": {
                "start": 73,
                "end": 75
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
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "body"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 94,
                              "end": 98
                            }
                          }
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
