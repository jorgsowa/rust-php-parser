===source===
<?php
function tmpl() {
    foo();
    ?>
<div>
<?php // comment ?>
    <p>text</p>
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
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "foo"
                        },
                        "span": {
                          "start": 28,
                          "end": 31,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 33,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 39,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "InlineHtml": "\n<div>\n"
              },
              "span": {
                "start": 41,
                "end": 48,
                "start_line": 4,
                "start_col": 6
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 65,
                "end": 67,
                "start_line": 6,
                "start_col": 17
              }
            },
            {
              "kind": {
                "InlineHtml": "\n    <p>text</p>\n"
              },
              "span": {
                "start": 67,
                "end": 84,
                "start_line": 6,
                "start_col": 19
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 94,
                "end": 97,
                "start_line": 9,
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
                          "start": 94,
                          "end": 97,
                          "start_line": 9,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 99,
                    "start_line": 9,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 94,
                "end": 101,
                "start_line": 9,
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
        "end": 102,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102,
    "start_line": 1,
    "start_col": 0
  }
}
