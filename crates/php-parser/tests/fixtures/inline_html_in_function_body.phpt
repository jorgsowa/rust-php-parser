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
          "name": "tmpl",
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
                          "end": 30,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "foo"
                              },
                              "span": {
                                "start": 33,
                                "end": 36,
                                "start_line": 3,
                                "start_col": 9
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 38,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 38,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 44,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "InlineHtml": "\n<div>html</div>\n"
              },
              "span": {
                "start": 46,
                "end": 63,
                "start_line": 4,
                "start_col": 6
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 73,
                "end": 76,
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
                          "Identifier": "bar"
                        },
                        "span": {
                          "start": 73,
                          "end": 76,
                          "start_line": 7,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 73,
                    "end": 78,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 73,
                "end": 80,
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
        "end": 81,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81,
    "start_line": 1,
    "start_col": 0
  }
}
