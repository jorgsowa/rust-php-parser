===source===
<?php
function tmpl() {
    $x = foo();
    ?>
<div>html</div>
<?php
    bar();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "tmpl",
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
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 28,
                          "end": 30
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 33,
                                    "end": 36
                                  }
                                }
                              },
                              "span": {
                                "start": 33,
                                "end": 36
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 38
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 39
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 44,
                "end": 47
              }
            },
            {
              "kind": {
                "InlineHtml": "<div>html</div>\n"
              },
              "span": {
                "start": 47,
                "end": 63
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
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 73,
                              "end": 76
                            }
                          }
                        },
                        "span": {
                          "start": 73,
                          "end": 76
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 73,
                    "end": 78
                  }
                }
              },
              "span": {
                "start": 73,
                "end": 79
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
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
